<?php

Route::get('/', function () {
   return view('welcome');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin\Auth'], function () {

   Route::get('/', 'XacThucController@getDangNhap')->name('admin.login');
   Route::get('login', 'XacThucController@getDangNhap')->name('admin.login.page');
   Route::post('login', 'XacThucController@postDangNhap')->name('admin.login.page');
   Route::get('logout', 'XacThucController@getDangXuat')->name('admin.logout');

});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['nhanvien', 'checkquantri']], function () 
{

	Route::group(['prefix' => 'nguyen-lieu'], function(){
		Route::get('/', 'NguyenLieuController@getIndex')->name('nguyenlieu.index');
		Route::get('them-moi', 'NguyenLieuController@getThem')->name('nguyenlieu.them');
		Route::post('them-moi', 'NguyenLieuController@postThem')->name('nguyenlieu.them');
		Route::get('chinh-sua/{id}', 'NguyenLieuController@getSua')->name('nguyenlieu.sua');
		Route::post('chinh-sua/{id}', 'NguyenLieuController@postSua')->name('nguyenlieu.sua');
	});


	Route::group(['prefix' => 'san-pham'], function(){
		Route::get('/', 'SanPhamController@getIndex')->name('sanpham.index');
		Route::get('them-moi', 'SanPhamController@getThem')->name('sanpham.them');
		Route::post('them-moi', 'SanPhamController@postThem')->name('sanpham.them');
		Route::get('chinh-sua/{id}', 'SanPhamController@getSua')->name('sanpham.sua');
		Route::post('chinh-sua/{id}', 'SanPhamController@postSua')->name('sanpham.sua');
	});

	Route::group(['prefix' => 'nha-phan-phoi'], function(){
		Route::get('/', 'NhaPhanPhoiController@getIndex')->name('nhaphanphoi.index');
		Route::get('them-moi', 'NhaPhanPhoiController@getThem')->name('nhaphanphoi.them');
		Route::post('them-moi', 'NhaPhanPhoiController@postThem')->name('nhaphanphoi.them');
		Route::get('chinh-sua/{id}', 'NhaPhanPhoiController@getSua')->name('nhaphanphoi.sua');
		Route::post('chinh-sua/{id}', 'NhaPhanPhoiController@postSua')->name('nhaphanphoi.sua');
	});

	Route::group(['prefix' => 'nhan-vien'], function(){
		Route::get('/', 'NhanVienController@getIndex')->name('nhanvien.index');
		Route::get('them-moi', 'NhanVienController@getThem')->name('nhanvien.them');
		Route::post('them-moi', 'NhanVienController@postThem')->name('nhanvien.them');
		Route::get('chinh-sua/{id}', 'NhanVienController@getSua')->name('nhanvien.sua');
		Route::post('chinh-sua/{id}', 'NhanVienController@postSua')->name('nhanvien.sua');
	});

	Route::group(['prefix' => 'nhan-vien-san-xuat'], function(){
		Route::get('/', 'NhanVienSanXuatController@getIndex')->name('nhanviensanxuat.index');
		Route::get('them-moi', 'NhanVienSanXuatController@getThem')->name('nhanviensanxuat.them');
		Route::post('them-moi', 'NhanVienSanXuatController@postThem')->name('nhanviensanxuat.them');
		Route::get('chinh-sua/{id}', 'NhanVienSanXuatController@getSua')->name('nhanviensanxuat.sua');
		Route::post('chinh-sua/{id}', 'NhanVienSanXuatController@postSua')->name('nhanviensanxuat.sua');
	});

	Route::group(['prefix' => 'nhap-kho'], function(){
		Route::get('/', 'NhapKhoController@getIndex')->name('nhapkho.index');
		Route::get('them-moi', 'NhapKhoController@getThem')->name('nhapkho.them');
		Route::post('them-moi', 'NhapKhoController@postThem')->name('nhapkho.them');
		Route::get('chi-tiet/{id}', 'NhapKhoController@getChiTiet')->name('nhapkho.chitiet');
	});

	Route::group(['prefix' => 'xuat-kho'], function(){
		Route::get('/', 'XuatKhoController@getIndex')->name('xuatkho.index');
		Route::get('them-moi', 'XuatKhoController@getThem')->name('xuatkho.them');
		Route::post('them-moi', 'XuatKhoController@postThem')->name('xuatkho.them');
		Route::get('chi-tiet/{id}', 'XuatKhoController@getChiTiet')->name('xuatkho.chitiet');
	});

	Route::group(['prefix' => 'san-xuat-wallet'], function(){
		Route::get('/', 'SanXuatWalletController@getIndex')->name('sanxuatwallet.index');
		Route::get('them-moi', 'SanXuatWalletController@getThem')->name('sanxuatwallet.them');
		Route::post('them-moi', 'SanXuatWalletController@postThem')->name('sanxuatwallet.them');
		Route::get('chi-tiet/{id}', 'SanXuatWalletController@getChiTiet')->name('sanxuatwallet.chitiet');
	});

	Route::group(['prefix' => 'san-xuat-napkin'], function(){
		Route::get('/', 'SanXuatNapKinController@getIndex')->name('sanxuatnapkin.index');
		Route::get('them-moi', 'SanXuatNapKinController@getThem')->name('sanxuatnapkin.them');
		Route::post('them-moi', 'SanXuatNapKinController@postThem')->name('sanxuatnapkin.them');
		Route::get('chi-tiet/{id}', 'SanXuatNapKinController@getChiTiet')->name('sanxuatnapkin.chitiet');
	});

	Route::group(['prefix' => 'thong-ke'], function(){
		Route::get('nguyen-lieu-ton-kho', 'ThongKeController@getNguyenLieuTonKho')->name('thongke.nguyenlieutonkho');
		Route::get('doanh-thu', 'ThongKeController@getDoanhThu')->name('thongke.doanhthu');
	});

	Route::group(['prefix' => 'tien-von'], function(){
		Route::get('/', 'TienVonController@getIndex')->name('tienvon.index');
		Route::get('them-moi', 'TienVonController@getThemTienVon')->name('tienvon.them');
		Route::post('them-moi', 'TienVonController@postThemTienVon')->name('tienvon.them');
		Route::get('rut-tien', 'TienVonController@getRutTien')->name('tienvon.ruttien');
		Route::post('rut-tien', 'TienVonController@postRutTien')->name('tienvon.ruttien');
	});

	Route::get('lich-su-rut-tien', 'TienVonController@getLichSuRutTien')->name('tienvon.lichsu');

	Route::group(['prefix' => 'tool'], function(){
		Route::post('xoa-bo', 'ToolController@postXoaBo')->name('tool.xoabo');
		Route::get('select-sanpham', 'ToolController@ajaxChonSanPhamSanXuat')->name('tool.ajax.sanpham');
		Route::get('get-so-tien-no-xuat-kho', 'ToolController@ajaxGetSoTienConNo')->name('tool.get.tien.no.xuat.kho');
		Route::post('tra-no-xuat-kho', 'ToolController@ajaxTraNo')->name('tool.tra.no');
		Route::get('get-lich-su-cong-no', 'ToolController@getLichSuCongNo')->name('tool.get.lich.su.cong.no');
	});

});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'nhanvien'], function () 
{
	Route::get('/dashboard', 'QuanLyController@getQuanLy')->name('admin.dashboard');

	Route::group(['prefix' => 'quan-ly-luong'], function(){
		Route::get('nhan-vien-napkin', 'LuongNhanVienController@getLuongNhanVienNapKin')->name('luong.nhanviennapkin');
		Route::get('nhan-vien-wallet', 'LuongNhanVienController@getLuongNhanVienWallet')->name('luong.nhanvienwallet');
	});
	
});