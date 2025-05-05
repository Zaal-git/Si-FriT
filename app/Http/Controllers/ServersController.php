<?php

    namespace App\Http\Controllers;

    use App\Models\Servers;
    use Illuminate\Http\Request;

    class ServersController extends Controller
    {
        public function index()
        {
            $servers = Servers::all();
            return view('master-data.server.main', [
                'title' => 'Master Data - Server',
                'servers' => $servers
            ]);
        }

        public function create()
        {
            //
        }

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'ip_address' => 'required|ip|unique:servers,ip_address',
                'location' => 'required',
                'memory_gb' => 'nullable|integer|min:0',
                'storage_gb' => 'nullable|integer|min:0',
                'status' => 'required|boolean',
            ]);

            Servers::create([
                'name' => $request->name,
                'ip_address' => $request->ip_address,
                'location' => $request->location,
                'memory_gb' => $request->memory_gb,
                'storage_gb' => $request->storage_gb,
                'status' => $request->status,
            ]);

            // Untuk request AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Server berhasil ditambahkan'
                ]);
            }

            // Untuk request biasa
            return redirect('master-data/server')->with('alert', [
                'type' => 'success',
                'message' => 'Server berhasil ditambahkan'
            ]);
        }

        public function edit($id)
        {
            $server = Servers::findOrFail($id);

            if (request()->ajax()) {
                return response()->json($server);
            }

            return view('master-data.server.edit', compact('server'));
        }

        public function update(Request $request, $id)
        {
            $request->validate([
                'name' => 'required',
                'ip_address' => 'required|ip|unique:servers,ip_address,' . $id,
                'location' => 'required',
                'memory_gb' => 'nullable|integer|min:0',
                'storage_gb' => 'nullable|integer|min:0',
                'status' => 'required|boolean',
            ]);

            $server = Servers::findOrFail($id);

            $server->update([
                'name' => $request->name,
                'ip_address' => $request->ip_address,
                'location' => $request->location,
                'memory_gb' => $request->memory_gb,
                'storage_gb' => $request->storage_gb,
                'status' => $request->status,
            ]);

            // Untuk request AJAX
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Server berhasil ditambahkan'
                ]);
            }

            return redirect('master-data/server')->with('alert', [
                'type' => 'success',
                'message' => 'Server berhasil diperbarui'
            ]);
        }

        public function destroy($id)
        {
            try {
                $server = Servers::findOrFail($id);
                $server->delete();

                return response()->json([
                    'success' => true,
                    'message' => 'Server berhasil dihapus'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus server: ' . $e->getMessage()
                ], 500);
            }
        }
    }
