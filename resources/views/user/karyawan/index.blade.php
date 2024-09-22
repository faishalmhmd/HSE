<x-app-layout>
    <x-sidebar />
    <div class="w-full p-5">
        <div class="bg-white dark:bg-zinc-900 dark:border-zinc-700 p-4 border overflow-x-auto rounded-xl">
            <div class="p-5" x-data="paginationHandler()" x-init="init();">
                <a href="{{ route('add-karyawan') }}">
                    <div class="flex justify-between">
                        <div class="text-2xl font-bold mb-4 text-black dark:text-white">Data Karyawan</div>
                        <div
                            class="text-xl text-white font-bold mb-4 flex items-center bg-green-400 hover:bg-green-500 transition duration-150 ease-in-out p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M20 18L17 18M17 18L14 18M17 18V15M17 18V21M11 21H4C4 17.134 7.13401 14 11 14C11.695 14 12.3663 14.1013 13 14.2899M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z"
                                    stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Tambah Karyawan
                        </div>
                    </div>
                </a>
                <table
                    class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700 rounded">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-zinc-700 text-black dark:text-white">
                            <template x-for="(column, index) in columns" :key="index">
                                <th class="border px-4 py-2 text-left cursor-pointer" :style="{ width: column.width }"
                                    @click="sortTable(column.field)">
                                    <span x-text="column.label"></span>
                                    <span x-show="sortField === column.field"
                                        x-text="sortDirection === 'asc' ? '▲' : '▼'"></span>
                                </th>
                            </template>
                        </tr>
                    </thead>
                    <tbody>
                        <template x-for="(employee, index) in filteredEmployees" :key="employee.id">
                            <tr>
                                <template x-for="(column, index) in columns" :key="index">
                                    <td class="border px-4 py-2 text-black dark:text-white"
                                        :style="{ width: column.width }" x-text="employee[column.field]"></td>
                                </template>
                            </tr>
                        </template>
                    </tbody>
                </table>
                <div class="mt-4">
                    <button class="px-4 py-2 bg-gray-300 rounded" :disabled="!pagination.prev_page_url"
                        @click="fetchData(pagination.prev_page_url)">
                        Previous
                    </button>

                    <button class="px-4 py-2 bg-gray-300 rounded" :disabled="!pagination.next_page_url"
                        @click="fetchData(pagination.next_page_url)">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/administrator/karyawan.index.js') }}"></script>
</x-app-layout>
