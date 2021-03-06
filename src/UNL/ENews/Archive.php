<?php
class UNL_ENews_Archive extends LimitIterator implements Countable
{
	public $newsroom;
	public $options = array('limit'=>25, 'offset'=>0);
	
    function __construct($options = array())
    {
        if (!isset($options['shortname'])) {
            throw new Exception('No shortname was provided.', 400);
        }

        $this->options = $options + $this->options;

        $this->newsroom = UNL_ENews_Newsroom::getByShortname($this->options['shortname']);
        $newsletters = $this->newsroom->getNewsletters(array('distributed'=>true));
        parent::__construct($newsletters, (int)$this->options['offset'], (int)$this->options['limit']);
    }

    function count()
    {
        $iterator = $this->getInnerIterator();
        if ($iterator instanceof EmptyIterator) {
            return 0;
        }

        return count($this->getInnerIterator());
    }
    
    static function getByShortName($shortname)
    {
        $options = array('shortname' => $shortname);
        return new self($options);
    }
}