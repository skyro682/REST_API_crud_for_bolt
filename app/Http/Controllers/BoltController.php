<?php

namespace App\Http\Controllers;

use App\Models\Bolt;
use App\Models\Server;
use App\Http\Requests\StoreBoltRequest;
use App\Http\Requests\UpdateBoltRequest;

class BoltController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Bolt::where('enabled', true)->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBoltRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoltRequest $request)
    {
        $server = Server::find($request['server_id']);
        
        if($server->Bolts()->where('name', $request['name'])->exists()) return response('The server already have a bolt with this name', 406); 
         
        $bolt = $server->Bolts()->create([
            'name' => $request['name'],
            'enabled' => ($request['enabled'] ? '1' : '0')
        ]);

        return $bolt;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bolt  $bolt
     * @return \Illuminate\Http\Response
     */
    public function show(Bolt $bolt)
    {
        return $bolt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBoltRequest  $request
     * @param  \App\Models\Bolt  $bolt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBoltRequest $request, Bolt $bolt)
    {
        if($bolt->server_id == $request['server_id']) /* Same Server */ {

            if($bolt->name == $request['name']) /* Same Name */ {
                $bolt->update($request->all());
                return $bolt;
            } else /* New Name */ {
                $server = $bolt->Server;
                if($server->Bolts()->where('name', $request['name'])->exists()){
                    return response('The server already have a bolt with this name', 406);
                } else {
                    $bolt->update($request->all());
                    return $bolt;
                }
            }

        } else /* Change Server */ {
            $server = Server::find($request['server_id']);
            if($server->Bolts()->where('name', $request['name'])->exists()){
                return response('The server already have a bolt with this name', 406);
            } else {
                $bolt->name = $request['name'];
                $bolt->enabled = $request['enabled'];
                $bolt->server_id = $request['server_id'];
                $bolt->save();
                return $bolt;
            }
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bolt  $bolt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bolt $bolt)
    {
        $bolt->delete();
        return response('', 204);        
    }
}
