<?php

	class Fields{
		
		static $form;
		
		static function init(){
			self::$form = new HTMLForm();
			return self::$form;
		}
	
		private static function add($field,$args){
			
			$fieldgroup = self::$form->fieldgroup();
			
			if(array_key_exists('label',$args))
			{
				$label = self::$form->label();
				$label->add($args['label']);
				$label->add($field);
				$fieldgroup->add($label);
			}else
			{
				$fieldgroup->add($field);
			}
				
			foreach($args as $k => $v){
			
				$field->$k = $v;
			}
			
			self::$form->add($fieldgroup);
			
			return $field;
		}
		
		static function Entry($args)
		{
			$field = self::$form->entry();
			$field = self::add($field,$args);
			return $field;
		}
		
		
		static function Text($args)
		{
			$field = self::$form->text();
			self::add($field,$args);
			return $field;
		}
		
		static function Email($args)
		{
			$field = self::$form->entry();
			self::add($field,$args);
			return $field;
		}
		
		static function Password($args)
		{
			$field = self::$form->entry();
			self::add($field,$args);
			return $field;
		}
		
		static function File($args)
		{
			$field = self::$form->file();
			self::add($field,$args);
			return $field;
		}
		
		static function Choice($args)
		{
			$field = self::$form->select();
			self::add($field,$args);

			return $field;
		}
		
		static function render(){
			return self::$form->render();
		}
	
	
	
	
	}