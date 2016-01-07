<?php

/**
 * Copyright 2016 by Denis Mitrofanov
 */

/**
 * @param $message
 * @return mixed
 */
function flash($title, $message)
{
	return \App\Http\FlashMessage::flash($title, $message);
}


function overlay($title, $message)
{
	return \App\Http\FlashMessage::overlay($title, $message);
}

function aside($titlle, $message)
{
	return \App\Http\FlashMessage::aside($titlle, $message);
}
