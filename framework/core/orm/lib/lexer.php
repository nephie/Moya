<?php
namespace Moya\core\orm\lib;

class lexer {
	
	protected $catchablePatterns = array(
			'[a-z_\\\][a-z0-9_\:\\\]*[a-z0-9_]{1}',
            '(?:[0-9]+(?:[\.][0-9]+)*)(?:e[+-]?[0-9]+)?',
            "'(?:[^']|'')*'",
            '\?[1-9][0-9]*|:[a-z0-9_]+'
        );
        
    protected $nonCatchablePatterns = array('\s+', '(.)');  
    
    protected $input;
    protected $tokens;
    protected $position = 0;
    
    public $query;
    
    public function parse($input){
    	$this->input = $input;
    	$this->tokens = $this->tokenize($input);
    	
print_r($this->tokens);
    	
    	$this->query = new query();
    	
    	$this->walkTokens();
    	
    	
    }
    
    protected function walkTokens(){
    	
    	while($this->position < count($this->tokens)){
    		$identParserName = '\Moya\core\orm\lib\parser\\' . strtolower($this->getCurrentToken());
    		
	    	try {
	    		$identParser = new $identParserName();
	    	}
	    	catch(\Exception $e){
	    		throw new \Exception('Invalid query syntax: unknown identifier \'' . strtolower($this->getCurrentToken()) . '\'');
	    	}
	    	$this->moveNext();
	    	
	    	$identParser->parse($this);
	    	
	    	print_r($this->query);
    	}
    	
    }
    
    public function moveNext(){
    	$this->position++;
    }
    
    public function getCurrentToken(){
    	return $this->tokens[$this->position];
    }
    
    public function getNextToken(){
    	return $this->tokens[$this->position + 1];
    }
    
    public function isNextToken($input){
    	return (strtolower($input) == strtolower($this->tokens[$this->position + 1])) ? true : false;
    }
    
    /**
     * Scans the input string for tokens.
     *
     * @param string $input a query string
     */
    public function tokenize($input)
    {
        static $regex;
        $tokens = array();

        if ( ! isset($regex)) {
            $regex = '/(' . implode(')|(', $this->catchablePatterns) . ')|' 
                   . implode('|', $this->nonCatchablePatterns) . '/i';
        }

        $flags = PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_OFFSET_CAPTURE;
        $matches = preg_split($regex, $input, -1, $flags);

        foreach ($matches as $match) {                     
            $tokens[] = $match[0];
        }
        
        return $tokens;
    }

}	

?>