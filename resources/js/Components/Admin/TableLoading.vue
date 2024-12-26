<template>
    <div class="animate-pulse overflow-x-auto">
        <div class="inline-block min-w-full py-2 align-middle">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="w-1/6 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-500 sm:pl-6">
                                <span class="bg-gray-500">Field 1</span>
                            </th>
                            <th scope="col" class="w-1/6 px-3 py-3.5 text-left text-sm font-semibold text-gray-500">
                                <span class="bg-gray-500">Field 2</span>
                            </th>
                            <th scope="col" class="w-1/6 px-3 py-3.5 text-left text-sm font-semibold text-gray-500">
                                <span class="bg-gray-500">Field 3</span>
                            </th>
                            <th scope="col" class="w-1/6 px-3 py-3.5 text-left text-sm font-semibold text-gray-500">
                                <span class="bg-gray-500">Field 4</span>
                            </th>
                            <th scope="col" class="w-1/6 px-3 py-3.5 text-left text-sm font-semibold text-gray-500">
                                <span class="bg-gray-500">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <tr v-for="index in 10" :key="index">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-300 sm:pl-6">
                                <span class="bg-gray-300">Data 1</span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                <span class="bg-gray-300">Data 2</span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                <span class="bg-gray-300">Data 3</span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                <span class="bg-gray-300">Data 4</span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                <span class="bg-gray-300">Action</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
