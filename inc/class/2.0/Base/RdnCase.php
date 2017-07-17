<?php

namespace Base;

class RdnCase extends Element
{
    
    public $case_id = 0;
    
    protected $case_info = null;
    
    public function getCaseStatus()
    {
        return $this -> getCaseInfo() -> status;
    }
    
    public function getCaseInfo()
    {
        if (!$this -> case_info)
        {
            $this -> _getCaseData(); 
        }

        return $this->case_info;
    }
    
   protected function _getCaseData()
   {
       $this -> case_info = new RdnCaseInfo($this->case_id);
       $this -> case_info = setData();
   }
   
   
    
    
    
    
}








