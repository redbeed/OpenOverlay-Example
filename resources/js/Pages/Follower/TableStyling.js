export default {
    table: {
        tableWrapper: 'shadow overflow-hidden border-b border-gray-200 sm:rounded-lg',
        tableClass: 'w-full divide-y divide-gray-200 table-auto',
        tableHeaderClass: 'bg-gray-50',
        tableBodyClass: 'bg-white divide-y divide-gray-200',
        loadingClass: 'loading',
        ascendingIcon: 'fa fa-chevron-up',
        descendingIcon: 'fa fa-chevron-down',
        ascendingClass: 'sorted-asc',
        descendingClass: 'sorted-desc',
        sortableIcon: 'fa fa-sort',
        detailRowClass: 'px-6 py-4 whitespace-nowrap',
        handleIcon: 'fa fa-bars text-secondary',
        renderIcon(classes, options) {
            return `<i class="${classes.join(' ')}"></span>`
        }
    },

    pagination: {
        wrapperClass: 'relative z-0 inline-flex rounded-md shadow-sm -space-x-px',
        activeClass: 'bg-indigo-50 border-indigo-500 text-indigo-600',
        disabledClass: 'disabled',
        pageClass: 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium',
        linkClass: 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium',
        paginationClass: 'pagination',
        paginationInfoClass: 'float-left',
        dropdownClass: 'form-control',
        icons: {
            first: 'fa fa-angles-left',
            prev: 'fa fa-angle-left',
            next: 'fa fa-angle-right',
            last: 'fa fa-angles-right',
        }
    }
}
