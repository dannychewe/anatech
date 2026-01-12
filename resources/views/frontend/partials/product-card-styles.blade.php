@once
@push('styles')
<style>
    .product-card {
        background: #ffffff;
        border: 1px solid rgba(14, 99, 255, 0.15);
        border-radius: 24px;
        overflow: hidden;
        min-height: 100%;
        display: flex;
        flex-direction: column;
        transition: border-color 0.2s ease;
    }

    .product-card:hover {
        border-color: rgba(14, 99, 255, 0.35);
    }

    .product-card__thumb {
        position: relative;
        height: 220px;
        overflow: hidden;
        border-radius: 22px;
        margin: 0 1.5rem;
        margin-top: 1.5rem;
    }

    .product-card__thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 18px;
    }

    .product-card__badge {
        position: absolute;
        top: 16px;
        left: 16px;
        padding: 6px 16px;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #0e63ff;
        background: rgba(14, 99, 255, 0.08);
        letter-spacing: 0.05em;
    }

    .product-card__body {
        padding: 1rem 1.5rem 1.6rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .product-card__title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #07112a;
        margin-bottom: 0.4rem;
    }

    .product-card__title a {
        color: inherit;
        text-decoration: none;
    }

    .product-card__title a:hover {
        color: #0e63ff;
    }

    .product-card__description {
        color: #4f5c71;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .product-card__meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
        color: #586376;
        margin-bottom: 1rem;
    }

    .product-card__footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        gap: 0.75rem;
    }

    .product-card__footer .tp-btn {
        padding: 0.65rem 1.4rem;
        font-size: 0.9rem;
    }

    .tp-btn-sm {
        padding: 0.55rem 1.1rem;
        font-size: 0.85rem;
    }

    .product-card__price {
        font-weight: 700;
        color: #0e63ff;
        font-size: 1rem;
    }

    .product-detail-card,
    .product-detail-card--alt {
        background: #ffffff;
        border-radius: 30px;
        padding: 2rem;
        border: 1px solid rgba(7, 17, 42, 0.08);
    }

    .product-detail-card__badge {
        color: #0e63ff;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        margin-bottom: 0.6rem;
        display: inline-flex;
    }

    .product-detail-card__title {
        font-size: 1.9rem;
        font-weight: 700;
        color: #07112a;
        margin-bottom: 0.5rem;
    }

    .product-detail-card__meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        color: #4f5c71;
        font-size: 0.95rem;
        margin-bottom: 1rem;
    }

    .product-detail-card__meta span {
        display: flex;
        align-items: center;
        gap: 0.35rem;
    }

    .product-detail-card__actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
        margin-top: 1.2rem;
    }

    .product-detail-card__summary {
        margin-top: 1.8rem;
        color: #4f5c71;
        line-height: 1.7;
    }

    .product-gallery {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .product-gallery__main {
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(7, 17, 42, 0.08);
    }

    .product-gallery__main img {
        width: 100%;
        height: 420px;
        object-fit: cover;
        display: block;
    }

    .product-gallery__thumbs {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .product-gallery__thumb {
        border-radius: 16px;
        border: 1px solid transparent;
        padding: 0.2rem;
        background: transparent;
        cursor: pointer;
        transition: border 0.2s ease;
    }

    .product-gallery__thumb img {
        width: 72px;
        height: 72px;
        object-fit: cover;
        border-radius: 12px;
        display: block;
    }

    .product-gallery__thumb.active {
        border-color: #0e63ff;
    }

    .product-detail-card__actions .tp-btn-second {
        min-width: 175px;
    }

    @media (max-width: 991px) {
        .product-card__thumb {
            margin: 1.25rem;
        }
    }

    @media (max-width: 768px) {
        .product-card {
            border-radius: 18px;
        }

        .product-card__thumb {
            height: 200px;
            margin: 1rem;
        }

        .product-card__footer {
            flex-direction: column;
            align-items: flex-start;
        }

        .product-detail-card,
        .product-detail-card--alt {
            padding: 1.4rem;
        }
    }
</style>
@endpush
@endonce
