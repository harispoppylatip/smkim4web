@props([
    'src' => '',
    'alt' => '',
    'containerClass' => '',
])

@if ($src)
    <div class="media-card relative overflow-hidden bg-surface-container-low rounded-2xl {{ $containerClass }}">
        {{-- Layer 1: Blurred background fill --}}
        <div class="absolute inset-0 overflow-hidden" aria-hidden="true">
            <img src="{{ $src }}"
                class="w-full h-full object-cover scale-150 blur-2xl opacity-60 will-change-transform" alt=""
                loading="lazy">
        </div>
        {{-- Layer 2: Main image --}}
        <div class="absolute inset-0 flex items-center justify-center p-0 media-card-main">
            <img src="{{ $src }}"
                class="w-full h-full transition-transform duration-300 group-hover:scale-105 will-change-transform media-card-img"
                alt="{{ $alt }}" loading="lazy">
        </div>
    </div>

    @once
        @push('styles')
            <style>
                /* ===== MEDIA CARD ORIENTATION SYSTEM ===== */
                .media-card {
                    transition: aspect-ratio 0.3s ease;
                }

                /* Landscape: aspect-ratio 16:9, object-cover fills container */
                .media-card.landscape {
                    aspect-ratio: 16 / 9;
                }

                .media-card.landscape .media-card-img {
                    object-fit: cover;
                }

                /* Portrait: object-contain, ratio set dynamically by JS */
                .media-card.portrait .media-card-img {
                    object-fit: contain;
                }

                /* Square: aspect-ratio 1:1, object-cover fills container */
                .media-card.square {
                    aspect-ratio: 1 / 1;
                }

                .media-card.square .media-card-img {
                    object-fit: cover;
                }
            </style>
        @endpush

        @push('scripts')
            <script>
                (function() {
                    'use strict';

                    function detectOrientation(card, img) {
                        if (card.dataset.orientation) return; // already processed
                        if (!img.naturalWidth) return;

                        var w = img.naturalWidth;
                        var h = img.naturalHeight;
                        var ratio = w / h;

                        var orientation;
                        if (ratio > 1.1) {
                            orientation = 'landscape';
                        } else if (ratio < 0.9) {
                            orientation = 'portrait';
                        } else {
                            orientation = 'square';
                        }

                        card.classList.add(orientation);
                        card.dataset.orientation = orientation;

                        // For portrait: set aspect-ratio to match image's natural ratio
                        if (orientation === 'portrait') {
                            card.style.aspectRatio = w + ' / ' + h;
                        }
                    }

                    function initMediaCards() {
                        document.querySelectorAll('.media-card').forEach(function(card) {
                            var img = card.querySelector('.media-card-img');
                            if (!img || card.dataset.orientation) return;

                            if (img.complete && img.naturalWidth) {
                                detectOrientation(card, img);
                            } else {
                                img.addEventListener('load', function() {
                                    detectOrientation(card, img);
                                });
                            }
                        });
                    }

                    // Run on DOMContentLoaded
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', initMediaCards);
                    } else {
                        initMediaCards();
                    }

                    // Observe dynamically added cards (e.g. after filter/pagination)
                    if (window.MutationObserver) {
                        var observer = new MutationObserver(function() {
                            initMediaCards();
                        });
                        observer.observe(document.body, {
                            childList: true,
                            subtree: true
                        });
                    }
                })
                ();
            </script>
        @endpush
    @endonce
@endif
