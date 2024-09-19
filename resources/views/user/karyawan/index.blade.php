<x-app-layout>
    <x-sidebar />
    <div class="w-full p-5">
        <div class="bg-white dark:bg-zinc-800 dark:border-zinc-700 p-4 border overflow-x-auto rounded-xl">
            <div class="p-5" x-data="paginationHandler()" x-init="init();">
                <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700 rounded">
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
