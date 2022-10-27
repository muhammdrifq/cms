<?php

namespace App\Http\Controllers;

use App\Models\Tb_galeri;
use App\Models\Tb_kategori_galeri;
use App\Models\Tb_menu;
use App\Models\Tb_slide;
use App\Models\Tb_submenu;
use App\Models\Tb_sdm;
use App\Models\Tb_wilayah;
use App\Models\Tb_kelembagaan;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function welcome()
    {
        $slide = Tb_slide::all();
        return view('welcome', compact('slide'));
    }

    public function menu(Tb_menu $tb_menu)
    {
        $menu = Tb_menu::find($tb_menu->id);
        $slide = Tb_slide::all();
       
        
        $kategoriGaleri = Tb_kategori_galeri::all();
        return view('member.menu', compact('menu', 'slide', 'kategoriGaleri'));
    }

    public function submenu(Tb_submenu $tb_submenu)
    {
        $submenu = Tb_submenu::find($tb_submenu->id);
        $slide = Tb_slide::all();
        $kategoriGaleri = Tb_kategori_galeri::all();
        
        return view('member.submenu', compact('submenu', 'slide', 'kategoriGaleri'));
    }

    public function galeri(Tb_kategori_galeri $tb_kategori_galeri)
    {
        $kategoriGaleri = Tb_kategori_galeri::find($tb_kategori_galeri->id);
        $galeri = Tb_galeri::where('id_kategori_galeri', $tb_kategori_galeri->id)->get();
        return view('member.galeri', compact('kategoriGaleri', 'galeri'));
    }
}
