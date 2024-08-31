<?php
/*
    Template class
    handle all template tasks - displaying views, alerts, errors and view data 
  */

use function PHPSTORM_META\type;

class Template
{
  private $data;
  private $alert_types = array('success','alert','error');
  function __construct()
  {
  }
  /**
   * Load specified template
   *
   * @access public
   * @param string
   * @return url
   **/
  public function load($url, $title='')
  {
    if($title != '') {$this->setData('page_title',$title);}
    include($url);
  }

  /**
   * redirect specific template
   *
   * @access public
   * @param string
   * @return null
   **/
  public function redirect($url)
  {
    header('Location: ' . $url);
    exit();
  }

  /* 
     * Get / Set data
  */

  /**
   * Saves provided data for use by the view later
   * 
   * @access public
   * @param string,string, bool
   * @return null
   */
  public function setData($name, $value, $clean = false)
  {
    if ($clean == true) {
      $this->data[$name] = htmlentities($value, ENT_QUOTES);
    } else {
      $this->data[$name] = $value;
    }
  }
  /**
   * Retrieves data for the view
   * 
   * @access public
   * @param string, boolean
   * @return null | string
   * 
   * */
  public function getData($name, $echo=true){
    if(isset($this->data[$name])){
      if($echo)
      {
        echo $this->data[$name];
      }
      else
      {
        return $this->data[$name];
      }
    }
    return '';
  }

  /* 
     * Get / Set data
  */

  /**
   * Set alert message stored in the session
   * 
   * @access public
   * @param string, string(optional)
   * @return null 
   * 
   * */
  public function setAlert($value, $type = 'success')
  {
    $_SESSION[$type][] = $value;
  }

  /**
   * Get string, containing multiple list items of alert
   * 
   * @access public
   * @param 
   * @return null 
   * 
   * */

  public function getAlert()
  {
    $data ='';
    foreach ($this->alert_types as $alert) 
    {
      if(isset($_SESSION[$alert]))
      {
        foreach($_SESSION[$alert] as $value)
        {
          $data .= '<li class="'.$alert.'">'. $value .'</li>';
        }
        unset($_SESSION[$alert]);
      }
    }
    echo $data;
  }
}
