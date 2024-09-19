<x-app-layout>
    <x-sidebar />
    <div class="w-full p-5">
        <div class="bg-white dark:bg-zinc-800 dark:border-zinc-700 p-4 border overflow-x-auto rounded-xl">
            <div class="p-5" x-data="paginationHandler()" x-init="init();">
                Tambah data karyawan
            </div>
        </div>
        <script src="{{ asset('js/administrator/karyawan.index.js') }}"></script>
</x-app-layout>
