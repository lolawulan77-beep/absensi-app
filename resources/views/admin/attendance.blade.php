<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Rekap Absensi</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded p-6 overflow-x-auto">

                <form method="GET" class="mb-4 flex gap-2">
                    <input type="date" name="tanggal" value="{{ $tanggal }}" class="border rounded px-3 py-2">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Filter</button>
                </form>

                <table class="w-full text-sm text-left">
                    <thead class="border-b">
                        <tr>
                            <th class="py-2">NIP</th>
                            <th>Nama</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $row)
                            <tr class="border-b">
                                <td class="py-2">{{ $row->user->nip }}</td>
                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->jam_masuk ?? '-' }}</td>
                                <td>{{ $row->jam_pulang ?? '-' }}</td>
                                <td class="capitalize">{{ $row->status }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="py-4 text-center text-gray-500">Tidak ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">{{ $data->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>