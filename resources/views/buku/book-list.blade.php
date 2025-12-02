<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-lg">
                <div class="p-8">
                    {{-- Loading indicator --}}
                    <div id="loading" class="text-center py-8">
                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
                        <p class="mt-2 text-gray-600">Loading books...</p>
                    </div>

                    {{-- Book list container --}}
                    <div id="book-list" class="space-y-4 hidden">
                        {{-- Books will be injected here by JavaScript --}}
                    </div>

                    {{-- Pagination --}}
                    <div id="pagination" class="mt-8 flex justify-center items-center gap-4 hidden mb-6">
                        <button id="prev-btn" 
                                class="px-6 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed transition-colors duration-200 shadow-md"
                                disabled>
                            Previous
                        </button>
                        <span id="page-info" class="text-gray-700 font-semibold px-4">Page 1 of 1</span>
                        <button id="next-btn" 
                                class="px-6 py-2.5 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 disabled:bg-gray-300 disabled:cursor-not-allowed transition-colors duration-200 shadow-md"
                                disabled>
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentPage = 1;
        let lastPage = 1;
        let nextPageUrl = null;
        let prevPageUrl = null;

        // Fetch books from API
        async function fetchBooks(page = 1) {
            const loading = document.getElementById('loading');
            const bookList = document.getElementById('book-list');
            const pagination = document.getElementById('pagination');

            loading.classList.remove('hidden');
            bookList.classList.add('hidden');
            pagination.classList.add('hidden');

            try {
                const response = await fetch(`/api/books?page=${page}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to fetch books');
                }

                const result = await response.json();
                
                // Update pagination info
                currentPage = result.meta.current_page;
                lastPage = result.meta.last_page;
                nextPageUrl = result.links.next;
                prevPageUrl = result.links.prev;

                // Render books
                renderBooks(result.data);
                updatePagination();

                loading.classList.add('hidden');
                bookList.classList.remove('hidden');
                pagination.classList.remove('hidden');

            } catch (error) {
                console.error('Error fetching books:', error);
                loading.innerHTML = '<p class="text-red-600">Error loading books. Please try again.</p>';
            }
        }

        // Render books to the page
        function renderBooks(books) {
            const bookList = document.getElementById('book-list');
            
            if (books.length === 0) {
                bookList.innerHTML = '<p class="text-gray-600 text-center">No books found.</p>';
                return;
            }

            bookList.innerHTML = books.map(book => `
                <div class="bg-gradient-to-r from-gray-50 to-white border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow duration-200">
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">${book.judul}</h3>
                    <p class="text-sm text-gray-600 mb-2">
                        <span class="font-semibold">by</span> ${book.pengarang}
                    </p>
                    <div class="flex items-center gap-4 text-sm">
                        <p class="text-gray-700">
                            <span class="font-semibold">Price:</span> 
                            <span class="text-green-600 font-bold">Rp ${parseInt(book.harga).toLocaleString('id-ID')}</span>
                        </p>
                        <p class="text-gray-600">
                            <span class="font-semibold">Published:</span> ${formatDate(book.tgl_terbit)}
                        </p>
                    </div>
                </div>
            `).join('');
        }

        // Format date to readable format
        function formatDate(dateString) {
            const date = new Date(dateString);
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            return date.toLocaleDateString('id-ID', options);
        }

        // Update pagination buttons and info
        function updatePagination() {
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const pageInfo = document.getElementById('page-info');

            // Update page info text
            pageInfo.textContent = `Page ${currentPage} of ${lastPage}`;

            // Enable/disable buttons
            prevBtn.disabled = !prevPageUrl;
            nextBtn.disabled = !nextPageUrl;
        }

        // Event listeners for pagination buttons
        document.getElementById('prev-btn').addEventListener('click', () => {
            if (prevPageUrl) {
                fetchBooks(currentPage - 1);
            }
        });

        document.getElementById('next-btn').addEventListener('click', () => {
            if (nextPageUrl) {
                fetchBooks(currentPage + 1);
            }
        });

        // Initial load
        fetchBooks(1);
    </script>
</x-app-layout>
