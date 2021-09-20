<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['jobs'] = Job::all();
        return view('admin.job.index', $data);
    }

    public function api_index()
    {
        $data['jobs'] = Job::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.job.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|max:80',
            'position' => 'required',
            'expired_date' => 'required',
            'description' => 'required|max:1000',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $job = new Job();
        $job->job_title = $request->job_title;
        $job->position = $request->position;
        $job->expired_date = $request->expired_date;
        $job->description = $request->description;

        if ($request->file('featured_image') != '') {
            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);

            $job->featured_image = $imageName;
        }

        $job->save();

        return redirect()->route('job.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['job'] = Job::find($id);

        return view('admin.job.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'job_title' => 'required|max:80',
            'position' => 'required',
            'expired_date' => 'required',
            'description' => 'required|max:1000',
            'featured_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $job = Job::find($request->id);
        $job->job_title = $request->job_title;
        $job->position = $request->position;
        $job->expired_date = $request->expired_date;
        $job->description = $request->description;

        if ($request->file('featured_image') != '') {
            unlink('images/' . $job->featured_image);

            $image = $request->file('featured_image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);

            $job->featured_image = $imageName;
        }

        $job->save();

        return redirect()->route('job.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        if ($job->featured_image != '') {
            unlink('images/' . $job->featured_image);
        }

        $job->delete();

        return redirect()->back();
    }
}
