<?php

namespace App\Observers;

use App\Models\DangKyChuyenPhong;
use App\Models\SinhVien;

class DangKyChuyenPhongObserver
{
    /**
     * Handle the DangKyChuyenPhong "created" event.
     */
    public function created(DangKyChuyenPhong $dangKyChuyenPhong): void
    {
        //
    }

    /**
     * Handle the DangKyChuyenPhong "updated" event.
     */
    public function updated(DangKyChuyenPhong $dangKyChuyenPhong): void
    {
        if($dangKyChuyenPhong->TrangThaiXetDuyet == "Thành công")
        SinhVien::where("MaSV",$dangKyChuyenPhong->MaSV)
                ->update([
                    "MaPhong"=>$dangKyChuyenPhong->MaPhongMoi
                ]);
    }

    /**
     * Handle the DangKyChuyenPhong "deleted" event.
     */
    public function deleted(DangKyChuyenPhong $dangKyChuyenPhong): void
    {
        //
    }

    /**
     * Handle the DangKyChuyenPhong "restored" event.
     */
    public function restored(DangKyChuyenPhong $dangKyChuyenPhong): void
    {
        //
    }

    /**
     * Handle the DangKyChuyenPhong "force deleted" event.
     */
    public function forceDeleted(DangKyChuyenPhong $dangKyChuyenPhong): void
    {
        //
    }
}
