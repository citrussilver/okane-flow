<script setup>
import { ref, computed, watch, inject } from 'vue'
import { defineEmits } from 'vue';

const emit = defineEmits(['selection-change','edit-row', 'delete-row']);

import { useModal } from '@/composables/useModal.js'
const { showModal } = useModal()

import AnimatedButton from '@/Components/AnimatedButton.vue'

// Props
const props = defineProps({
  rows: {
    type: Array,
    required: true,
  },
  cols: {
    type: Array, // Example: ['name', 'category', 'points', 'status']
    required: true,
  },
  filterField: {
    type: String,
    default: '' // If empty, no filter shown
  }
})

// refs vars - vue reactive variables
const currentPage = ref(1)

const selectedCategory = ref('')
const rowsPerPage= ref(10)
const searchQuery = ref('')

const dataTableRowsPerPage = [5, 10, 25, 50, 100]

// For checkboxes
const selectedRows = ref([])

watch(selectedRows, (newVal) => {
  emit('selection-change', newVal)
})

// reset currentPage to 1 when searchQuery changes:
watch(searchQuery, () => {
  currentPage.value = 1
})

// Get unique categories
// const uniqueCategories = computed(() => {
//   const categories = props.rows.map(row => row.category)
//   return [...new Set(categories)]
// })

const uniqueFilterOptions = computed(() => {
  if (!props.filterField) return []
  const values = props.rows.map(row => row[props.filterField]).filter(Boolean)
  return [...new Set(values)]
})

const selectedFilterValue = ref('')

// Filter by category, global search in all columns
const filteredRows = computed(() => {
  let result = [...props.rows]

  // return selectedCategory.value
  //   ? props.rows.filter(row => row.category === selectedCategory.value)
  //   : props.rows

  // Filter by category if selected
  // if (selectedCategory.value) {
  //   // pick one column from fetched data, e.g. category, class 
  //   // then adjust e.g. row.category, row.<insert-actual-column-name-here>
  //   result = result.filter(row => row.category === selectedCategory.value)
  // }

  if (props.filterField && selectedFilterValue.value) {
    result = result.filter(row => row[props.filterField] === selectedFilterValue.value)
  }

  // Apply global search
  if (searchQuery.value.trim() !== '') {
    const query = searchQuery.value.toLowerCase()
    result = result.filter(row =>
      props.cols.some(col => {
        const value = row[col.key]
        return String(value).toLowerCase().includes(query)
      })
    )
  }

  return result
})

// Sort rows
const sortedRows = computed(() => {
  if (!sortKey.value) return filteredRows.value

  return [...filteredRows.value].sort((a, b) => {
    const valA = a[sortKey.value]
    const valB = b[sortKey.value]

    if (valA == null || valB == null) return 0

    const typeA = typeof valA
    const typeB = typeof valB

    if (typeA === 'number' && typeB === 'number') {
      return sortAsc.value ? valA - valB : valB - valA
    }

    return sortAsc.value
      ? String(valA).localeCompare(String(valB))
      : String(valB).localeCompare(String(valA))
  })
})

// Paginate
const paginatedRows = computed(() => {
  const start = (currentPage.value - 1) * rowsPerPage.value
  return sortedRows.value.slice(start, start + rowsPerPage.value)
})

const totalPages = computed(() =>
  Math.ceil(sortedRows.value.length / rowsPerPage.value)
)

// For sorting
const sortKey = ref('')
const sortAsc = ref(true)

// Sorting Actions
const toggleSort = (col) => {

  // apply sorting only to columns that have sortable: true
  if (!col.sortable) return

  if (sortKey.value === col.key) {
    sortAsc.value = !sortAsc.value
  } else {
    sortKey.value = col.key
    sortAsc.value = true
  }
}

const toggleRow = (rowId) => {

  // ignore disabled rows
  const row = props.rows.find(r => r.id === rowId)
  if (!row || row.disabled) return

  if (selectedRows.value.includes(rowId)) {
    selectedRows.value = selectedRows.value.filter(id => id !== rowId)
  } else {
    selectedRows.value.push(rowId)
  }
}

// All row IDs from the current page
const visibleRowIds = computed(() => paginatedRows.value.map(row => row.id))

const allChecked = computed(() =>
  visibleRowIds.value.every(id => selectedRows.value.includes(id))
)

const isIndeterminate = computed(() =>
  selectedRows.value.some(id => visibleRowIds.value.includes(id)) &&
  !allChecked.value
)

const toggleAllVisible = () => {
  // skip disabled rows

  const selectableIds = paginatedRows.value
    .filter(row => !row.disabled)
    .map(row => row.id)

  if (selectableIds.every(id => selectedRows.value.includes(id))) {
    // Uncheck all
    selectedRows.value = selectedRows.value.filter(id => !selectableIds.includes(id))
  } else {
    // Check all
    const updated = new Set([...selectedRows.value, ...selectableIds])
    selectedRows.value = Array.from(updated)
  }
}

const deleteBulkSelected = async (rows) => {

  const confirmed = await showModal('Are you sure you want to delete the selected items?')
  if (confirmed) {
    console.log('✅ user confirmed!')
    // proceed to delete logic here
  } else {
    console.log('❌ user canceled')
  }
}

// for showing props.cols anywhere
// const getLabel = (key) => props.cols.find(col => col.key === key)?.label || key

const buildRowDetails = (row) => {
  return props.cols
    .filter(col => col.key in row && col.label) // only visible + valid keys
    .slice(0, 2) // limit to 2
    .map(col => `${col.label}: ${row[col.key]}`)
    .join('<br>')
  // return Object.keys(row)
  //   .filter(key => getLabel(key)) // optional: only include columns that exist in `cols`
  //   .map(key => `${getLabel(key)}: ${row[key]}`)
  //   .join('<br>')
}

const editSelectedRow = (row) => {

  console.log('🧪 row received for edit:', row)

  emit('edit-row', row);
}

const deleteSelectedRow = (row) => {
  console.log('🧪 row received for delete:', row)

  emit('delete-row', {
    row,
    details: buildRowDetails(row),
  });
}
</script>

<template>
  <div class="space-y-4">

    <!-- TEST to show selected rows -->
    <!-- <pre class="text-xs text-gray-500 dark:text-gray-400">Selected: {{ selectedRows }}</pre> -->
    <!-- Actions Slot -->
    <div v-if="$slots.actions" class="mb-4">
      <slot name="actions" :selected-rows="selectedRows" />
    </div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-[1rem]">
      <div class="flex flex-col sm:flex-row gap-[1rem]">
        <!-- Bulk Action button -->
        <!-- Bulk Delete -->
        <AnimatedButton
          :disabled="selectedRows.length === 0"
          color="red-600"
          @click="deleteBulkSelected(selectedRows)"
        >
          <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
          </svg>
          <span class="sr-only">Delete Selected</span>
        </AnimatedButton>
        <!-- Search input -->
        <div class="w-full sm:max-w-xs">
          <!-- <label for="search" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
            Search
          </label> -->
          <input
            type="text"
            id="search"
            v-model="searchQuery"
            placeholder="Search table..."
            class="block w-full text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5
                  bg-gray-50 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
          />
        </div>
      </div>
      <!-- div wrapper - Category and Rows per page selector -->
      <div class="flex items-center justify-between">
        <!-- Category Filter -->
        <!-- Filter Dropdown (Dynamic field) -->
        <div v-if="filterField && uniqueFilterOptions.length" class="w-fit">
          <select
            v-model="selectedFilterValue"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                  focus:ring-blue-500 focus:border-blue-500 block w-52 p-2.5
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
          >
            <option value="">All</option>
            <option
              v-for="option in uniqueFilterOptions"
              :key="option"
              :value="option"
            >
              {{ option }}
            </option>
          </select>
        </div>
        <!-- <div class="w-fit">
          <select
            v-model="selectedCategory"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                  focus:ring-blue-500 focus:border-blue-500 block w-52 p-2.5
                  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
          >
            <option value="">All Categories</option>
            <option v-for="cat in uniqueCategories" :key="cat" :value="cat">
              {{ cat }}
            </option>
          </select>
        </div> -->
        <!-- Rows per page selector -->
        <div class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
          <label for="rows-per-page" class="ml-1">Show</label>
          <select
            id="rows-per-page"
            v-model.number="rowsPerPage"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                  focus:ring-blue-500 focus:border-blue-500 
                  dark:bg-gray-700 dark:border-gray-600 dark:text-white"
          >
            <option 
              v-for="rowsPerPage in dataTableRowsPerPage"
              :value="rowsPerPage"
            >
              {{ rowsPerPage }}
            </option>
          </select>
          <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" d="M3 11h18M3 15h18m-9-4v8m-8 0h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/></svg>
          <span class="sr-only">entries per page</span>
        </div>
      </div>
    </div>
    <!-- Table -->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-pale-silver dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th class="px-4 py-3">
              <div class="flex items-center">
                  <input 
                    id="checkbox-all-search" 
                    type="checkbox" 
                    :checked="allChecked" 
                    :indeterminate="isIndeterminate" 
                    @change="toggleAllVisible"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                  >
                  <label for="checkbox-all-search" class="sr-only">checkbox</label>
              </div>
            </th>
            <th
              v-for="col in cols"
              :key="col.key"
              :class="['px-6 py-3 cursor-pointer select-none', col.class]"
              @click="toggleSort(col)"
            >
              <div class="flex items-center">
                {{ col.label }}
                <div v-if="col.sortable === true" class="ml-1">
                  <span v-if="sortKey === col.key">
                    {{ sortAsc ? '▲' : '▼' }}
                  </span>
                  <svg v-else class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/></svg>
                </div>
              </div>
            </th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="row in paginatedRows"
            :key="row.id"
            class="bg-white border-b odd:bg-white odd:dark:text-vampire-black odd:dark:bg-dark-elec-blue even:bg-gray-50 even:dark:bg-gray-800 dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-olivine-500 dark:hover:bg-dark-liver hover:text-black-choco dark:hover:text-white"
          >
            <td class="px-4 py-2">
              <input 
                type="checkbox" 
                :value="row.id" 
                :disabled="row.disabled" 
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" 
                :checked="selectedRows.includes(row.id)" 
                @change="toggleRow(row.id)" 
              />
            </td>
            <td
              v-for="col in cols"
              :key="col.key"
              :class="[
                'px-6 py-4',
                typeof row[col.key] === 'number' ? 'text-right' : 'text-left', 
                col.class
              ]"
            >
              <template v-if="col.key === 'avatar'">
                <img
                  :src="row[col.key]"
                  alt="avatar"
                  class="w-8 h-8 rounded-full object-cover"
                />
              </template>
              <template v-else-if="col.key === 'status'">
                <!-- TODO: make reusable -->
                <span
                  :class="[
                    'inline-flex items-center px-2.5 py-0.5 rounded text-xs font-medium',
                    row.status === 'Alive' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300'
                      : row.status === 'Deceased' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'
                      : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300'
                  ]"
                >
                  {{ row[col.key] }}
                </span>
              </template>
              <template v-else-if="typeof row[col.key] === 'object' && row[col.key] !== null">
                {{ row[col.key][col.subKey || 'name'] }}
              </template>
              <template v-else>
                {{ row[col.key] }}
              </template>
            </td>
            <td class="px-6 py-4">
              <div class="flex justify-center">
                <AnimatedButton 
                  color=""
                  @click="editSelectedRow(row)"
                >
                  <span class="flex items-center justify-center p-1 rounded-full transition-all duration-200 hover:bg-shadow-blue group">
                    <svg class="w-6 h-6 text-inbike-green hover:text-vampire-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/></svg>
                  </span>
                  <span class="sr-only">Edit current row</span>
                </AnimatedButton>
                <AnimatedButton 
                  color=""
                  @click="deleteSelectedRow(row)"
                >
                  <span class="flex items-center justify-center p-1 rounded-full transition-all duration-200 hover:bg-shadow-blue group">
                    <svg class="w-6 h-6 text-electric-red" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" /></svg>
                  </span>
                  <span class="sr-only">Delete Selected</span>
                </AnimatedButton>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Flowbite Pagination style -->
    <div class="flex items-center justify-between mt-4">
      <div class="text-sm text-gray-700 dark:text-gray-300">
        Page {{ currentPage }} of {{ totalPages }}
      </div>
      <nav class="inline-flex -space-x-px text-sm">
        <button
          @click="currentPage--"
          :disabled="currentPage === 1"
          class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300
                 rounded-l-lg hover:bg-olivine-500 hover:text-white dark:bg-gray-800
                 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        >
          Prev
        </button>
        <button
          v-for="page in totalPages"
          :key="page"
          @click="currentPage = page"
          :class="[
            'px-3 py-2 leading-tight border border-gray-300',
            currentPage === page
              ? 'text-white bg-olivine-500 dark:text-gray-400 dark:bg-gray-700 border-blue-600'
              : 'text-gray-500 bg-white hover:bg-olivine-500 hover:text-white dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
          ]"
        >
          {{ page }}
        </button>
        <button
          @click="currentPage++"
          :disabled="currentPage === totalPages"
          class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300
                 rounded-r-lg hover:bg-olivine-500 hover:text-white dark:bg-gray-800
                 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
        >
          Next
        </button>
      </nav>
    </div>
  </div>
</template>