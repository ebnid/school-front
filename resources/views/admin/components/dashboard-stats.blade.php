<div class="bg-white md:bg-transparent p-5 md:p-0">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <article
        class="flex flex-col gap-4 rounded-lg border border-gray-100 bg-white p-6"
        >
            <div
                class="inline-flex gap-2 self-end rounded bg-green-100 p-1 text-green-600"
            >
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                />
                </svg>
            </div>

            <div>
                <strong class="block text-sm font-medium text-gray-500">Estimate Salary </strong>

                <p>
                    <span class="text-2xl font-medium text-gray-900"> BDT {{ number_format($salary, 2) }} </span>
                    <span class="text-xs text-gray-500"> from {{ \Carbon\Carbon::create(now()->year, now()->month, 1)->format('d M Y') }} </span>
                </p>
            </div>
        </article>

        <article
        class="flex flex-col gap-4 rounded-lg border border-gray-100 bg-white p-6"
        >
            <div
                class="inline-flex gap-2 self-end rounded bg-green-100 p-1 text-green-600"
            >
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                />
                </svg>
            </div>

            <div>
                <strong class="block text-sm font-medium text-gray-500"> Withdraw </strong>

                <p>
                    <span class="text-2xl font-medium text-gray-900"> BDT {{ number_format($withdraw, 2) }} </span>
                    <span class="text-xs text-gray-500"> from {{ \Carbon\Carbon::create(now()->year, now()->month, 1)->format('d M Y') }} </span>
                </p>
            </div>
        </article>

        <article
        class="flex flex-col gap-4 rounded-lg border border-gray-100 bg-white p-6"
        >
            <div
                class="inline-flex gap-2 self-end rounded bg-green-100 p-1 text-green-600"
            >
                <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-4 w-4"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"
                />
                </svg>
            </div>

            <div>
                <strong class="block text-sm font-medium text-gray-500"> Balance </strong>

                <p>
                    <span class="text-2xl font-medium text-gray-900"> BDT {{ number_format($balance, 2) }} </span>
                    <span class="text-xs text-gray-500"> from {{ \Carbon\Carbon::create(now()->year, now()->month, 1)->format('d M Y') }} </span>
                </p>
            </div>
        </article>
    </div>
</div>
