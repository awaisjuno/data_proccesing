<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatasetModel;
use App\Models\DatasetAccess;
use App\Models\User;
use App\Models\AccessControl;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DatasetController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'set_name' => 'required|string|max:255',
                'set_description' => 'nullable|string',
            ]);

            DatasetModel::create([
                'set_name' => $request->set_name,
                'set_description' => $request->set_description,
                'created_by' => session('user_id'),
                'is_active' => '1',
                'is_delete' => '0',
            ]);

            return redirect()->back()->with('success', 'Dataset created successfully!');
        }

        $userId = session('user_id');

        // Own datasets or datasets shared with user
        $datasets = DatasetModel::where(function($query) use ($userId) {
            $query->where('created_by', $userId)
                  ->orWhereIn('set_id', function($sub) use ($userId) {
                      $sub->select('set_id')
                          ->from('access_control')
                          ->where('user_id', $userId)
                          ->where('is_delete', '0');
                  });
        })->where('is_delete', '0')->get();

        return view('dataset.manage', compact('datasets'));
    }

    public function update(Request $request, $id)
    {
        $dataset = DatasetModel::findOrFail($id);

        if ($dataset->created_by != session('user_id')) {
            abort(403);
        }

        $dataset->update([
            'set_name' => $request->set_name,
            'set_description' => $request->set_description,
        ]);

        return redirect()->route('datasets.index')->with('success', 'Dataset updated.');
    }

    public function delete($id)
    {
        $dataset = DatasetModel::findOrFail($id);

        if ($dataset->created_by != session('user_id')) {
            abort(403);
        }

        $dataset->update(['is_delete' => '1']);

        return redirect()->back()->with('success', 'Dataset deleted.');
    }

    public function searchUser(Request $request)
    {
        $term = $request->get('term');
        $users = User::where('email', 'LIKE', "%$term%")
                     ->where('is_active', '1')
                     ->where('is_delete', '0')
                     ->limit(10)->get(['user_id', 'email']);

        return response()->json($users);
    }

    public function grantAccess(Request $request)
    {
        $request->validate([
            'set_id' => 'required|exists:dataset,set_id',
            'user_id' => 'required|exists:user,user_id',
        ]);

        AccessControl::updateOrCreate(
            ['set_id' => $request->set_id, 'user_id' => $request->user_id],
            [
                'given_by' => session('user_id'),
                'is_active' => '1',
                'is_delete' => '0'
            ]
        );

        return response()->json(['status' => 'success']);
    }

    public function access($id)
    {
        $dataset = DatasetModel::findOrFail($id);

        if ($dataset->created_by != session('user_id')) {
            return redirect()->route('datasets.index')->with('error', 'Unauthorized access.');
        }

        $grantedUsers = DatasetAccess::where('set_id', $id)->with('user')->get();

        return view('dataset.access', compact('dataset', 'grantedUsers'));
    }

    public function edit($id)
    {
        $dataset = DatasetModel::findOrFail($id);

        if ($dataset->created_by != session('user_id')) {
            return redirect()->route('datasets.index')->with('error', 'Unauthorized access.');
        }

        return view('dataset.edit', compact('dataset'));
    }

}
