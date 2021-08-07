<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\MainController;

class CertificateController extends MainController
{
    public function addCertificateView(Request $request){
        return view('certificate.add')->with(['apiToken' => $this->apiToken]);
    }
    public function certificateListView(Request $request){
        if(Gate::allows('authAdmin')){
            $certificates = Certificate::select('certificates.id', 'certificates.type', 'certificates.position', 'users.fullname', 'events.name')->join('users', 'certificates.user_id', '=', 'users.id')->join('events', 'certificates.event_id', '=', 'events.id')->paginate(7);
            return view('certificate.list')->with(['certificates' => $certificates, 'apiToken' => $this->apiToken]);
        }else{
            $certificates = Certificate::select('certificates.id', 'certificates.type', 'certificates.position', 'users.fullname', 'events.name')->join('users', 'certificates.user_id', '=', 'users.id')->join('events', 'certificates.event_id', '=', 'events.id')->where('username', Auth::user()->username)->paginate(7);
            return view('certificate.list')->with(['certificates' => $certificates, 'apiToken' => $this->apiToken]);
        }
    }
    public function addEvent(Request $request){
        $validated = $request->validate([
            'username' => ['required'],
            'event-id' => ['required'],
            'certificate-type' => ['required'],
            'position' => ['required']
        ]);

        $username = strtolower($request->input('username'));
        $eventID = $request->input('event-id');
        $certificateType = strtolower($request->input('certificate-type'));
        $position = strtolower($request->input('position'));

        // Recheck if username and event id is existed in case user doesn't input one that actually existed although with the JS help lel
        if(User::where('username', $username)->first()){
            if(Event::where('id', $eventID)->first()){
                $userID = User::select('id')->where('username', $username)->first()->id;
                Certificate::create([
                    'user_id' => $userID,
                    'event_id' => $eventID,
                    'type' => $certificateType,
                    'position' => $position
                ]);
                $request->session()->flash('addCertificateSuccess', 'Sijil berjaya ditambah!');
                return back();
            }else{
                return back()->withInput()->withErrors([
                    'event-id' => 'ID Acara tidak dijumpai!'
                ]);
            }
        }else{
            return back()->withInput()->withErrors([
                'username' => 'Username Pengguna tidak dijumpai!'
            ]);
        }
    }
}