<?php

namespace App\Http\Controllers;

use App\DummyJson\DummyJson;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Str;

class DatabaseController extends Controller
{
    private array $service = [
        'posts' => [
            'title' => 'string|max:255|required',
        ],
        'products' => [
            'title' => 'string|max:255|required',
            'userId' => 'int|min:1|required',
        ],
        'users' => [
            'first_name' => 'string|max:255|required',
            'last_name' => 'string|max:255|required',
            'age' => 'int|min:0|required',
        ]
    ];

    function index(Request $request)
    {
        if($request->isMethod('POST'))
        {
            if($request->get('btn') === 'POST')
            {
                return $this->store($request);
            }

            return back()->with('data', json_encode($this->show($request), JSON_PRETTY_PRINT));
        }

        return view('index');
    }

    function store(Request $request)
    {
        $service = $request->get('service');

        if(!array_key_exists($service, $this->service))
        {
            return back()->withErrors('Table not found');
        }

        $data = $request->validate($this->service[$service]);

        $api = new DummyJson($service);

        $data = $api->add($data);

        return back()->with('success', 'Data added successfully');
    }

    function show(Request $request)
    {
        $service = $request->get('service');

        if(!array_key_exists($service, $this->service))
        {
            return back()->withErrors('Table not found');
        }
        
        $api = new DummyJson($service);

        return $api->get();
    }
}
