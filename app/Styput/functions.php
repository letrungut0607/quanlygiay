<?php

if(!function_exists('dinh_dang_ngay'))
{
	function dinh_dang_ngay($ngaythangnam)
	{
		if(empty($ngaythangnam))
			return null;
		return date('d-m-Y', strtotime($ngaythangnam));
	}
}

if(!function_exists('dinh_dang_ngay_gio'))
{
	function dinh_dang_ngay_gio($ngaythangnam)
	{
		if(empty($ngaythangnam))
			return null;
		return date('d-m-Y | H:i:s', strtotime($ngaythangnam));
	}
}

if(!function_exists('dinh_dang_ngay_mysql'))
{
	function dinh_dang_ngay_mysql($ngaythangnam)
	{
		return date('Y-m-d', strtotime($ngaythangnam));
	}
}

if(!function_exists('dinh_dang_ngay_gio_mysql'))
{
	function dinh_dang_ngay_gio_mysql($ngaythangnam)
	{
		return date('Y-m-d H:i:s', strtotime($ngaythangnam));
	}
}

if(!function_exists('kiemtra_admin'))
{
	function kiemtra_admin()
	{
		return Auth::user()->phanquyen === 1;
	}
}