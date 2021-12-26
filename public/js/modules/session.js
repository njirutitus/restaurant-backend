export default function setSession(key,value) {
    localStorage.setItem(key, JSON.stringify(value))
}

export function getSession(key) {
    return JSON.parse(localStorage.getItem(key))
}

export function removeSession(key) {
    localStorage.removeItem(key)
}

export function clearSession() {
    localStorage.clear()
}