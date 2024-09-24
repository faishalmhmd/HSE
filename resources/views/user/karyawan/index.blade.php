<x-app-layout>
    <x-sidebar />

    <div class="w-full p-5">
        <div class="bg-white dark:bg-zinc-900 dark:border-zinc-700 p-4 border overflow-x-auto rounded-xl">
            <div class="p-5" x-data="paginationHandler()" x-init="init();">
                <div class="mb-10">
                    <div class="grid grid-cols-8 gap-5">
                        <div
                            class="px-5 py-4  font-semibold border-gray-300 dark:border-zinc-500 border rounded-lg text-black dark:text-white">
                            <span class="flex items-center justify-between text-zinc-600 dark:text-white">
                                Karyawan Aktif
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                        stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                                        stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </span>

                            <p class="font-bold text-2xl">24</p>
                        </div>
                    </div>
                </div>
                <!-- Add Karyawan -->
                <div class="flex ">
                    <div class="text-2xl font-bold mb-4 mr-auto text-black dark:text-white">Data Karyawan</div>
                    <a href="{{ route('add-karyawan') }}">
                        <div
                            class="text-lg text-white font-bold mb-4 flex items-center bg-zinc-400 hover:bg-zinc-500 transition duration-150 ease-in-out p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M20 18L17 18M17 18L14 18M17 18V15M17 18V21M11 21H4C4 17.134 7.13401 14 11 14C11.695 14 12.3663 14.1013 13 14.2899M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z"
                                    stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Tambah Karyawan
                        </div>
                    </a>
                    <a href="{{ route('pdf-data-karyawan') }}" class="ml-2">
                        <div
                            class="text-lg text-white font-bold mb-4 flex items-center bg-zinc-400 hover:bg-zinc-500 transition duration-150 ease-in-out p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none">
                                <path
                                    d="M20 18L17 18M17 18L14 18M17 18V15M17 18V21M11 21H4C4 17.134 7.13401 14 11 14C11.695 14 12.3663 14.1013 13 14.2899M15 7C15 9.20914 13.2091 11 11 11C8.79086 11 7 9.20914 7 7C7 4.79086 8.79086 3 11 3C13.2091 3 15 4.79086 15 7Z"
                                    stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Export Data Karyawan
                        </div>
                    </a>
                </div>

                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-zinc-700 text-black dark:text-white ">
                            <template x-for="(column, index) in columns" :key="index">
                                <th class="border border-zinc-200 dark:border-zinc-500 px-4 py-2 text-left cursor-pointer"
                                    :style="{ width: column.width }" @click="sortTable(column.field)">
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
                                    <td class="border border-zinc-200 dark:border-zinc-500 px-4 py-2 text-black dark:text-white"
                                        :style="{ width: column.width }">
                                        <template x-if="column.field === 'actions'">
                                            <div class="flex space-x-2">
                                                <a :href="`/karyawan/${employee.id}/edit`"
                                                    class="bg-zinc-500 py-2 px-5 rounded-lg font-bold text-white hover:bg-zinc-600 transition duration-150 ease-in-ou">
                                                    Edit
                                                </a>
                                                <button @click="deleteEmployee(employee.id)"
                                                    class="bg-zinc-500 py-2 px-5 rounded-lg font-bold text-white">Delete</button>
                                            </div>
                                        </template>
                                        <template x-if="column.field === 'status'">
                                            <span
                                                :class="{
                                                    'bg-zinc-700 text-white rounded-lg border border-zinc-900 dark:border-zinc-600': employee[
                                                        column
                                                        .field] === 'active',
                                                    'bg-zinc-300 rounded-lg border border-zinc-400 text-zinc-700': employee[
                                                        column
                                                        .field] !== 'active'
                                                }"
                                                class="rounded-lg font-bold py-1 px-2"
                                                x-text="employee[column.field]"></span>
                                        </template>
                                        <template x-if="column.field !== 'actions' && column.field !== 'status'">
                                            <span x-text="employee[column.field]"></span>
                                        </template>

                                    </td>
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
