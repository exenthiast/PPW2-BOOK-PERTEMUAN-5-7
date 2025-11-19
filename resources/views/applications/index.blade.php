<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Pelamar - {{ $job->title }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">

        {{-- Tombol export --}}
        <div class="flex justify-end mb-4">
            <a href="{{ route('applications.export') }}"
               class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">
                Export ke Excel
            </a>
        </div>

        <div class="bg-white shadow sm:rounded-lg p-4">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="border-b">
                        <th class="px-6 py-4 text-left">Nama</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">CV</th>
                        <th class="px-6 py-4 text-left">Aksi</th>
                        <th class="px-6 py-4 text-left">Hubungi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applications as $app)
                        <tr class="border-b">
                            <td class="py-2">{{ $app->user->name }}</td>
                            <td class="py-2">{{ $app->user->email }}</td>

                            {{-- Badge status --}}
                            <td class="px-6 py-2">
                                @php
                                    $status = $app->status;
                                    $badgeClass = match ($status) {
                                        'Accepted' => 'bg-green-100 text-green-800',
                                        'Rejected' => 'bg-red-100 text-red-800',
                                        default     => 'bg-yellow-100 text-yellow-800',
                                    };
                                @endphp

                                <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $badgeClass }}">
                                    {{ $status }}
                                </span>
                            </td>

                            {{-- Tombol download CV --}}
                            <td class="px-6 py-2">
                                <a href="{{ route('applications.downloadCv', $app->id) }}"
                                   class="inline-flex items-center rounded-md bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-blue-700">
                                    Download CV
                                </a>
                            </td>

                            {{-- Aksi terima / tolak --}}
                            <td class="py-2">
                                <div class="flex items-center gap-2">
                                    {{-- Terima --}}
                                    <form action="{{ route('applications.update', $app->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="Accepted">
                                        <button type="submit"
                                                class="inline-flex items-center rounded-md bg-emerald-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-emerald-700"
                                                @if($app->status === 'Accepted') disabled @endif>
                                            Terima
                                        </button>
                                    </form>

                                    {{-- Tolak --}}
                                    <form action="{{ route('applications.update', $app->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="Rejected">
                                        <button type="submit"
                                                class="inline-flex items-center rounded-md bg-red-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-red-700"
                                                @if($app->status === 'Rejected') disabled @endif>
                                            Tolak
                                        </button>
                                    </form>
                                </div>
                            </td>

                            {{-- Tombol email --}}
                            <td class="px-6 py-2">
                                <a href="{{ route('kirim-email', ['application_id' => $app->id]) }}"
                                   class="inline-flex items-center rounded-md bg-blue-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-blue-700">
                                    Kirim Email
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-gray-500">
                                Belum ada pelamar untuk lowongan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
