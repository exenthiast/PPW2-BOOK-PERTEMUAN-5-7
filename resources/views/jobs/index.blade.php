<x-app-layout>
    @php 
        $isAdmin = auth()->check() && auth()->user()->role === 'admin';
    @endphp
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Lowongan Kerja') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            @if($jobs->isEmpty())
                {{-- Pesan kalau belum ada job sama sekali --}}
                <div class="bg-white shadow sm:rounded-lg p-6 text-center text-gray-600">
                    Belum ada lowongan yang tersedia.
                </div>
            @else
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    @if ($isAdmin)
                    <div class="flex items-center justify-between px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h3 class="font-semibold text-lg text-gray-800">
                            Kelola Lowongan Kerja Yang Tersedia
                        </h3>
                        
                        <a href="{{ route('jobs.create') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-black text-sm font-medium rounded-md hover:bg-indigo-700 transition-colors duration-200 shadow-md hover:shadow-lg">
                            Tambah Lowongan
                        </a>
                    </div>
                    @endif
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        JUDUL
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        PERUSAHAAN
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        LOKASI
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        GAJI
                                    </th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                        AKSI
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($jobs as $job)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <h3 class="text-sm font-semibold text-gray-800">
                                            {{ $job->title }}
                                        </h3>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $job->company }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $job->location }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp {{ number_format($job->salary, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center gap-4">
                                            <a href="{{ route('jobs.show', $job->id) }}"
                                               class="inline-flex items-center px-3 py-1.5 bg-gray-600 text-blue text-xs font-medium rounded-md hover:bg-gray-700 transition-colors duration-200">
                                                Detail
                                            </a>

                                            {{-- Form apply: upload CV --}}
                                            <form action="{{ route('applications.store', $job->id) }}"
                                                  method="POST"
                                                  enctype="multipart/form-data"
                                                  class="flex items-center gap-2">
                                                @csrf
                                                <input type="file" name="cv" class="text-xs" required>
                                                <button type="submit"
                                                        class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-black text-xs font-medium rounded-md hover:bg-indigo-700 transition-colors duration-200">
                                                    Lamar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
