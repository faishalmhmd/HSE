function paginationHandler() {
    return {
        data: [], // Changed employees to data
        filteredData: [], // Changed filteredEmployees to filteredData
        searchQuery: '',
        columns: [{
            label: 'No',
            field: 'id',
            width: '50px'
        },
        {
            label: 'Name',
            field: 'nama',
            width: '200px'
        },
        {
            label: 'Email',
            field: 'email',
            width: '250px'
        },
        {
            label: 'No Hp',
            field: 'no_hp',
            width: '250px'
        },
        {
            label: 'Status',
            field: 'status',
            width: '100px'
        },
        {
            label: 'Tanggal Masuk',
            field: 'tgl_masuk',
            width: '150px'
        },
        {
            label: 'Tanggal Lahir',
            field: 'tgl_lahir',
            width: '150px'
        },
        {
            label: 'Actions',
            field: 'actions',
            width: '150px'
        },],
        sortField: 'id',
        sortDirection: 'asc',
        pagination: {},

        fetchData(url = '/get-data-karyawan') {
            axios.get(url)
                .then(({
                    data
                }) => {
                    this.data = data.data // Changed employees to data
                    this.filteredData = [...this.data] // Changed filteredEmployees to filteredData
                    this.pagination = {
                        prev_page_url: data.prev_page_url,
                        next_page_url: data.next_page_url,
                    }
                    this.sortTable()
                })
                .catch(console.error)
        },

        init() {
            this.fetchData()
        },
        sortTable(field) {
            if (!this.filteredData.length) return // Changed filteredEmployees to filteredData
            this.sortDirection = (this.sortField === field) ? (this.sortDirection === 'asc' ? 'desc' : 'asc') :
                'asc'
            this.sortField = field

            this.filteredData.sort((a,b) => // Changed filteredEmployees to filteredData
                (a[field] === b[field]) ? 0 : (a[field] > b[field] ? 1 : -1) * (this.sortDirection === 'asc' ?
                    1 : -1)
            )
        },
        filterData() { // Changed filterEmployees to filterData
            const query = this.searchQuery
            if (query.trim() === '') {
                this.fetchData()
                return
            }
            axios.get(`/search-data-karyawan?search=${query}`)
                .then(({ data }) => {
                    this.filteredData = data.data // Changed filteredEmployees to filteredData
                    this.pagination = {
                        prev_page_url: data.prev_page_url,
                        next_page_url: data.next_page_url,
                    }
                })
                .catch(console.error)
        },
        deleteData(id) { // Changed deleteEmployee to deleteData
            if (confirm('Are you sure you want to delete this employee?')) {
                axios.delete(`/delete-employee/${id}`)
                    .then(() => {
                        this.fetchData()
                    })
                    .catch(console.error)
            }
        }
    }
}
