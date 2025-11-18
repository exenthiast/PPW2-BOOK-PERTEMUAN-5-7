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
                        <th class="py-2 text-left">Nama</th>
                        <th class="py-2 text-left">Email</th>
                        <th class="py-2 text-left">Status</th>
                        <th class="py-2 text-left">CV</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($applications as $app)
                        <tr class="border-b">
                            <td class="py-2">{{ $app->user->name }}</td>
                            <td class="py-2">{{ $app->user->email }}</td>
                            <td class="py-2">{{ $app->status }}</td>
                            <td class="py-2">
                                {{-- nanti bisa tambahin link download CV --}}
                                {{ $app->cv }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
