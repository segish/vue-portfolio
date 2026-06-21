function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';
}

export async function apiFetch(url, options = {}) {
    const isFormData = options.body instanceof FormData;

    const headers = {
        Accept: 'application/json',
        'X-CSRF-TOKEN': csrfToken(),
        ...options.headers,
    };

    if (options.body && !isFormData && !headers['Content-Type']) {
        headers['Content-Type'] = 'application/json';
    }

    return fetch(url, {
        credentials: 'same-origin',
        ...options,
        headers,
    });
}
