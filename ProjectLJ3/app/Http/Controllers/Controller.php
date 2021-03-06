<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use App\Stagelijst;
use App\Voorkeur;
use Illuminate\Support\Facades\Auth;
class Controller extends BaseController
{
    public function LoadHomepage()
    {
       $username = "";
       $email = "";
       // Check login status
       if (Auth::check())
       {
           $username = Auth::user()->name;
           $email = Auth::user()->email;
           $rol = Auth::user()->rol;
           return view('homepage', array('username'=>$username, 'email' =>$email, 'rol' => $rol));
       }
       else
       {
        return view('homepage', );
       }
       
       
    }
    public function LoadStagelijst()
    {
       $username = "";
       $email = "";
       // Check login status
       if (Auth::check())
       {
           $username = Auth::user()->name;
           $email = Auth::user()->email;
           $rol = Auth::user()->rol;
           return view('stagelijst', array('username'=>$username, 'email' =>$email, 'rol' => $rol));
        }
        else
        {
            return view('homepage');
        }

      
       
    }
    public function LoadFormulier()
    {
       $username = "";
       $email = "";
       // Check login status
       if (Auth::check())
       {
           $username = Auth::user()->name;
           $email = Auth::user()->email;
           $rol = Auth::user()->rol;
           $opleiding_sub = Voorkeur::getOpleidingSubs();
           return view('formulier', array('username'=>$username, 'email' =>$email, 'rol' => $rol, 'opleiding_sub' => $opleiding_sub));
       }
       else
       {
           return view('homepage');
       }
      
       
    }
    public function LoadBedrijvenMailen()
    {
       $username = "";
       $email = "";
       // Check login status
       if (Auth::check())
       {
           $username = Auth::user()->name;
           $email = Auth::user()->email;
           $rol = Auth::user()->rol;
           $uuid = Str::uuid()->toString();
           $bedrijven = Stagelijst::BedrijvenOphalen();
           if($rol == 1)
           {
              return view('mailbedrijven', array('username'=>$username, 'email' =>$email, 'rol' => $rol, 'uuid' => $uuid, 'bedrijven' => $bedrijven));
           }
           else
           {
              abort(404);
           }
           
       }
       else
       {
           return view('homepage');
       }
       
    }
    
    public function LoadBedrijfLogin()
    {
       return view('bedrijven');
    }
}
