<?php

class Helper
{
	public static function modelErrorsToMessage($model)
	{
		$msg = '';
		
		if (!empty($model->errors) && is_array($model->errors) && count($model->errors) > 0)
		{
			foreach ($model->errors as $key => $value)
			{
				$msg = $key.' - '.$value[0];
				break;
			}
		}
		
		return $msg;
	}
}