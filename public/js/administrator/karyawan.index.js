function paginationHandler() {
    return {
        employees: [],
        filteredEmployees: [],
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
            label: 'Tanggal Masuk',
            field: 'tgl_masuk',
            width: '150px'
        },
        {
            label: 'Tanggal Lahir',
            field: 'tgl_lahir',
            width: '150px'
        },
        ],
        sortField: 'id',
        sortDirection: 'asc',
        pagination: {},

        fetchData(url = '/karyawans') {
            axios.get(url)
                .then(({
                    data
                }) => {
                    this.employees = data.data
                    this.filteredEmployees = [...this.employees]
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
            if (!this.filteredEmployees.length) return
            this.sortDirection = (this.sortField === field) ? (this.sortDirection === 'asc' ? 'desc' : 'asc') :
                'asc'
            this.sortField = field

            this.filteredEmployees.sort((a,b) =>
                (a[field] === b[field]) ? 0 : (a[field] > b[field] ? 1 : -1) * (this.sortDirection === 'asc' ?
                    1 : -1)
            )
        }
    }
}