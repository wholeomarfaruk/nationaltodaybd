<!-- Photocard Modal -->
<div id="photocardModalContainer"
    x-data="{
        show: false,
        title: '',
        image: '',
        category: '',
        date: '',
        formatDate(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
        },
        async downloadImage() {
            const element = document.getElementById('photocard-canvas-target');
            if (!element) return;

            try {
                const canvas = await html2canvas(element, {
                    scale: 2,
                    useCORS: true,
                    logging: false,
                    backgroundColor: '#ffffff',
                    allowTaint: true,
                    pixelRatio: 2
                });

                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = `photocard-${Date.now()}.png`;
                link.click();

                this.show = false;
                if (typeof $toaster !== 'undefined') {
                    $toaster.fire({
                        icon: 'success',
                        title: 'Photocard downloaded successfully'
                    });
                }
            } catch (error) {
                console.error('Error generating photocard:', error);
                if (typeof $toaster !== 'undefined') {
                    $toaster.fire({
                        icon: 'error',
                        title: 'Failed to download photocard'
                    });
                }
            }
        }
    }"
    @showPhotocard.window="show = true; title = $event.detail.title; image = $event.detail.image; category = $event.detail.category; date = $event.detail.date"
    @keydown.escape.window="show = false">

    <!-- Backdrop -->
    <template x-if="show">
        <div class="fixed inset-0 z-40 bg-black/50" @click="show = false"></div>
    </template>

    <!-- Modal -->
    <template x-if="show">
        <div class="fixed inset-0 flex items-center justify-center z-50 p-4">
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Download Photocard</h3>
                        <button type="button" @click="show = false"
                            class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Preview -->
                    <div class="mb-6 flex justify-center overflow-auto max-h-[50vh] bg-gray-100 rounded-lg p-4">
                        <div id="photocard-canvas-target" class="relative w-[540px] h-[540px] flex-shrink-0 rounded-xl overflow-hidden shadow-lg"
                            :style="{ backgroundImage: `url('${image}')`, backgroundSize: 'cover', backgroundPosition: 'center' }">

                            <!-- Dark overlay -->
                            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/30 to-black/60"></div>

                            <!-- Content -->
                            <div class="absolute inset-0 flex flex-col justify-between p-6 text-white">
                                <!-- Top: Logo + Category -->
                                <div class="flex items-center justify-between">
                                    <img src="{{ asset('uploads/logo/logo.png') }}" alt="Logo" class="h-8 object-contain brightness-0 invert" />
                                    <template x-if="category">
                                        <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-sm font-medium" x-text="category"></span>
                                    </template>
                                </div>

                                <!-- Bottom: Title + Date -->
                                <div class="space-y-3">
                                    <h2 class="text-2xl font-bold leading-tight line-clamp-3"
                                        x-text="title"
                                        style="font-family: 'Noto Sans Bengali', sans-serif; font-weight: 700;"></h2>
                                    <div class="flex items-center gap-2 text-sm font-medium opacity-90">
                                        <span x-text="formatDate(date)"></span>
                                        <span>•</span>
                                        <span>nationaltodaybd.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3">
                        <button type="button" @click="downloadImage()"
                            class="flex-1 inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-3 text-sm font-medium text-white hover:bg-blue-700 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Download PNG
                        </button>
                        <button type="button" @click="show = false"
                            class="flex-1 inline-flex items-center justify-center gap-2 rounded-lg bg-gray-200 px-4 py-3 text-sm font-medium text-gray-800 hover:bg-gray-300 transition dark:bg-gray-700 dark:text-gray-100 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

@push('scripts')
    <script src="{{ asset('plugins/richtexteditor/plugins/html2pdf/html2canvas.min.js') }}"></script>
@endpush
