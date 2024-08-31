<?php

/**
 * Categories Class
 * Handle all tasks related to retrieving and displaying categories
 */

class Categories
{
  private $Database;
  private $db_table = 'categories';

  function __construct($Database)
  {
    $this->Database = $Database;
  }

  /*
    Setting/Getting categories from database
  */

  /**
   * Return an array with categories information
   * 
   * @access public
   * param int (optional)
   * @return array
   */

  public function getCategories($id = null)
  {
    $data = array();
    if ($id != null) {
      //get specific category
      $stmt = $this->Database->prepare("SELECT id, name FROM " . $this->db_table . " WHERE id = ? LIMIT 1");
      if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
          $cat_id = null;
          $cat_name = null;
          $stmt->bind_result($cat_id, $cat_name);
          $stmt->fetch();
          $data = array('id' => $cat_id, 'name' => $cat_name);
        }
        $stmt->close();
      }
    } else {
      //get all categories
      $result = $this->Database->query("SELECT id, name FROM " . $this->db_table . " ORDER BY name");
      if ($result) {
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $data[] = array('id' => $row['id'], 'name' => $row['name']);
          }
        }
      }
    }
    return $data;
  }

  /*
    Create page parts
  */

  /**
   * Create HTML for a navigation menu with categories
   *
   * @access public
   * @param string (optional)
   * @return string
   */
  public function get_category_nav($active = null)
  {
    // Lấy tất cả categories
    $categories = $this->getCategories();

    // Thiết lập mục 'View All'
    $data = '<li ';
    if (strtolower($active) === 'home') {
      $data .= 'class="active"';
    }
    $data .= '><a href ="' . SITE_PATH . '">View All</a></li>';

    // Lặp qua từng category
    if (!empty($categories)) {
      foreach ($categories as $category) {
        $data .= '<li';
        if (strtolower($active) === strtolower($category['name'])) {
          $data .= ' class="active"';
        }
        $data .= '><a href ="' . SITE_PATH . 'index.php?id=' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</a></li>';
      }
    }
    return $data;
  }
}
