<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Absensi Saya</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="p-4 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
            @endif

            {{-- Kartu absen hari ini --}}
            <div class="bg-white shadow rounded p-6">
                <p class="text-gray-600">{{ now()->translatedFormat('l, d F Y') }}</p>
                <p class="text-sm text-gray-500 mt-1">
                    Masuk: <b>{{ $today->jam_masuk ?? '-' }}</b> |
                    Pulang: <b>{{ $today->jam_pulang ?? '-' }}</b>
                </p>

                <div class="mt-4 flex gap-3">
                    <form method="POST" action="{{ route('absen.masuk') }}">
                        @csrf
                        <button class="px-4 py-2 bg-blue-600 text-white rounded disabled:opacity-40"
                            {{ $today ? 'disabled' : '' }}>Absen Masuk</button>
                    </form>

                    <form method="POST" action="{{ route('absen.pulang') }}">
                        @csrf
                        <button class="px-4 py-2 bg-emerald-600 text-white rounded disabled:opacity-40"
                            {{ !$today || $today->jam_pulang ? 'disabled' : '' }}>Absen Pulang</button>
                    </form>
                </div>
            </div>

            {{-- Riwayat --}}
            <div class="bg-white shadow rounded p-6 overflow-x-auto">
                <h3 class="font-semibold mb-3">Riwayat Absensi</h3>
                <table class="w-full text-sm text-left">
                    <thead class="border-b">
                        <tr>
                            <th class="py-2">Tanggal</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($riwayat as $r)
                            <tr class="border-b">
                                <td class="py-2">{{ \Carbon\Carbon::parse($r->tanggal)->format('d-m-Y') }}</td>
                                <td>{{ $r->jam_masuk ?? '-' }}</td>
                                <td>{{ $r->jam_pulang ?? '-' }}</td>
                                <td class="capitalize">{{ $r->status }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="py-4 text-center text-gray-500">Belum ada data.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $riwayat->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>