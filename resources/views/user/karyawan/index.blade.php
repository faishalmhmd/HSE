<x-app-layout>
    <x-sidebar />
    <div>
        <table id="default-table">
            <thead>
                <tr>
                    <th>
                        <span class="flex items-center">
                            Name
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th data-type="date" data-format="YYYY/DD/MM">
                        <span class="flex items-center">
                            No Hp
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Email
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            tgl lahir
                            <svg class="w-4 h-4 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                            </svg>
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody id="table-body">
                <!-- Data will be populated here -->
            </tbody>
        </table>

        <div id="pagination-controls">
            <!-- Pagination controls will be populated here -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/umd/simple-datatables.min.js"></script>
    <script>
        let currentPage = 1;
        let totalPages = 1;

        async function fetchData(page = 1) {
            try {
                const response = await axios.get(`/karyawans?page=${page}`);
                const {
                    data,
                    links
                } = response.data.data;

                const tableBody = document.getElementById('table-body');
                tableBody.innerHTML = ''; // Clear existing content

                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">${item.name}</td>
                        <td>${item.no_hp}</td>
                        <td>${item.email}</td>
                        <td>${item.tgl_lahir}</td>
                    `;
                    tableBody.appendChild(row);
                });

                totalPages = response.data.last_page;
                currentPage = page;
                updatePaginationControls(response.data.links);

                // Initialize DataTable after populating
                if (typeof simpleDatatables.DataTable !== 'undefined') {
                    new simpleDatatables.DataTable("#default-table", {
                        searchable: false,
                        perPageSelect: false
                    });
                }
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        function updatePaginationControls(links) {
            const paginationControls = document.getElementById('pagination-controls');
            paginationControls.innerHTML = ''; // Clear existing controls

            links.forEach(link => {
                if (link.url) {
                    const button = document.createElement('button');
                    button.innerText = link.label;
                    button.disabled = !link.active;
                    button.addEventListener('click', () => fetchData(new URL(link.url).searchParams.get('page')));
                    paginationControls.appendChild(button);
                }
            });
        }

        // Fetch data when the page loads
        document.addEventListener('DOMContentLoaded', () => fetchData(currentPage));
    </script>
</x-app-layout>
