<x-siswa-layout>
    <div class="pt-6">
        <div class="lg:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                        {{-- Breadcrumb --}}
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="flex space-x-2">
                            <li class="flex">
                                <a href="{{ route('pengurus_ekstra.dashboard') }}" class="text-gray-400 hover:text-gray-700">
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <div class="flex justify-center py-1">
                                <svg class="flex w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                                </svg>
                            </div>
                            <li class="flex">
                                <p class="font-semibold text-gray-700">
                                    <span>Perlengkapan</span>
                                </p>
                            </li>
                        </ol>
                    </nav>
                    <div class="flex justify-between items-center space-y-4">
                        <h2 class="text-2xl font-semibold text-gray-800">Perlengkapan Ekstrakurikuler {{  $nama_ekstrakurikuler }}</h2>
                        @if ($perlengkapan_ekstras)
                            <button data-modal-target="tambah" data-modal-toggle="tambah" class="block text-blue-700 border border-blue-700 hover:bg-blue-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800" type="button">
                                Tambah
                            </button>

                            <!-- Main modal -->
                            <div id="tambah" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Tambah Perlengkapan Ekstrakurikuler
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="tambah">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-4 md:p-5 space-y-4">
                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                Tambah barang untuk ekstrakurikuler {{ $nama_ekstrakurikuler }}
                                            </p>
                                            <div>
                                                <form action="{{ route('pengurus_ekstra.perlengkapan.store') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="id_ekstrakurikuler" value="{{ $id_ekstra }}">
                                                    <label for="nama_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Barang:</label>
                                                    <input autocomplete="off" placeholder="Nama Barang..." name="nama_barang" id="nama_barang" type="text" class="mt-1 block w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none focus:border-blue-300 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-blue-800 dark:focus:border-blue-800">
                                            </div>
                                            <div>
                                                <label for="stok" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stok:</label>
                                                <input autocomplete="off" placeholder="Stok..." name="stok" id="stok" type="number" class="mt-1 block w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none focus:border-blue-300 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-blue-800 dark:focus:border-blue-800">
                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                    <button data-modal-hide="tambah" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                                                </form>
                                                <button data-modal-hide="tambah" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        @if (session()->has('success'))
                        <x-alert-notification :color="'green'">
                            {{ session('success') }}
                        </x-alert-notification>
                        @endif

                    <div class="pt-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Histori Peminjaman</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($perlengkapan_ekstras as $index => $item)
                                    <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama_barang }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->stok }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <a href="{{ route('pengurus_ekstra.histori', $item->id_inventaris) }}" class="inline-flex items-center px-2 py-1 border border-gray-500 rounded-md font-semibold text-xs text-gray-500 uppercase tracking-widest hover:bg-gray-500 hover:text-white active:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                Detail
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex space-x-2">
                                            <button data-modal-target="edit-{{ $index }}" data-modal-toggle="edit-{{ $index }}" class="text-blue-600 hover:text-blue-900">
                                                <svg class="w-[28px] h-[28px] text-blue-600 dark:text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.9" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                                                </svg>                                          
                                            </button>

                                            <!-- Main modal -->
                                            <div id="edit-{{ $index }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                Edit Perlengkapan Ekstrakurikuler
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit-{{ $index }}">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="p-4 md:p-5 space-y-4">
                                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                                Edit barang ekstrakurikuler {{ $nama_ekstrakurikuler }}
                                                            </p>
                                                            <div>
                                                            <form action="{{ route('pengurus_ekstra.perlengkapan.update', $item->id_inventaris) }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="id_ekstrakurikuler" value="{{ $id_ekstra }}">
                                                                <label for="nama_barang" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Barang:</label>
                                                                <input autocomplete="off" placeholder="Nama Barang..." value="{{ $item->nama_barang }}" name="nama_barang" id="nama_barang" type="text" class="mt-1 block w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none focus:border-blue-300 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-blue-800 dark:focus:border-blue-800">
                                                            </div>
                                                            <div>
                                                                <label for="stok" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stok:</label>
                                                                <input autocomplete="off" placeholder="Stok..." value="{{ $item->stok }}" name="stok" id="stok" type="number" class="mt-1 block w-full border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none focus:border-blue-300 dark:bg-gray-800 dark:border-gray-600 dark:focus:ring-blue-800 dark:focus:border-blue-800">
                                                            </div>
                                                        </div>
                                                        <!-- Modal footer -->
                                                        <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                <button data-modal-hide="edit-{{ $index }}" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tambah</button>
                                                            </form>
                                                        <button data-modal-hide="edit-{{ $index }}" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('pengurus_ekstra.perlengkapan.delete', $item->id_inventaris) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">
                                                    <svg class="w-6 h-6 text-red-600 dark:text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                                    </svg>                                              
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-lg font-medium text-gray-900 text-center" colspan="4">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $perlengkapan_ekstras->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-siswa-layout>