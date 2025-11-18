<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Lowongan Pekerjaan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">

                {{-- Tampilkan error validasi --}}
                @if ($errors->any())
                    <div class="mb-4 text-sm text-red-600">
                        <ul class="list-disc ml-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('jobs.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="title">
                            Judul Lowongan
                        </label>
                        <input type="text" name="title" id="title"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                               value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="company">
                            Perusahaan
                        </label>
                        <input type="text" name="company" id="company"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                               value="{{ old('company') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="location">
                            Lokasi
                        </label>
                        <input type="text" name="location" id="location"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                               value="{{ old('location') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="salary">
                            Gaji (Rp)
                        </label>
                        <input type="number" name="salary" id="salary"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                               value="{{ old('salary') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700" for="description">
                            Deskripsi Pekerjaan
                        </label>
                        <textarea name="description" id="description" rows="5"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                  required>{{ old('description') }}</textarea>
                    </div>

                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('jobs.index') }}"
                           class="inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700">
                            Batal
                        </a>
                        <button type="submit"
                                class="inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-sm text-gray-700">
                            Simpan Lowongan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
