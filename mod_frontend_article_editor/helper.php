<?php
   /**
    * @package     Joomla.Administrator
    * @subpackage  com_croponent
    * @author      Michel Gerding en Dylan Spin
    * @copyright   Copyright (C) 2019
   
   */
		
   class ModFrontendArticleEditorHelper {
      /**
         * @param   array  $params An object containing the module parameters
         *
         * @access public
      */
      
      public function select($id = 1){
         
         $db = JFactory::getDbo();
         $query = $db->getQuery(true);
         $query->select('*');
         $query->from($db->quoteName('#__frontend_article_editor'));
         $query->where($db->quoteName('id')." = ".$db->quote($id));

         $db->setQuery($query);
         $result = $db->loadRow();
         
         if ( $result ) {
            return new Data($result[0], $result[1], $result[2], true);
         } else {
            return new Data(0, '', '', false);
         }
      }
          
      public function update($id = 1, $values = ['','']){

         $db = JFactory::getDbo();

         $query = $db->getQuery(true);

         // Fields to update.
         $fields = array(
            $db->quoteName('title') . ' = ' . $db->quote($values[0]),
            $db->quoteName('text') . ' = ' . $db->quote($values[1]),
            $db->quoteName('id') . ' = ' . $id
         );

         $conditions = array(
            $db->quoteName('id') . ' = ' . $id
         );

         $query->update($db->quoteName('#__frontend_article_editor'))->set($fields)->where($conditions);

         $db->setQuery($query);

         $result = $db->execute();
      }

   }

   class Data {
      public $id;
      public $title;
      public $text;
      public $succes;

      public function __construct($id = 0, $title = "", $text = "", $succes = false) {
         $this->id = $id;
         $this->title = $title;
         $this->text = $text;
         $this->succes = $succes;
      }
   }
?>
