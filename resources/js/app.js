import './bootstrap'
import './theme-manager'

import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

// DARK MODE TOGGLE BUTTON
var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon")
var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon")

if (
    localStorage.getItem("color-theme") === "dark" ||
    (!("color-theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    themeToggleLightIcon.classList.remove("hidden")
} else {
    themeToggleDarkIcon.classList.remove("hidden")
}

var themeToggleBtn = document.getElementById("theme-toggle")

themeToggleBtn.addEventListener("click",function () {
    themeToggleDarkIcon.classList.toggle("hidden")
    themeToggleLightIcon.classList.toggle("hidden")

    if (localStorage.getItem("color-theme")) {
        if (localStorage.getItem("color-theme") === "light") {
            document.documentElement.classList.add("dark")
            localStorage.setItem("color-theme","dark")
        } else {
            document.documentElement.classList.remove("dark")
            localStorage.setItem("color-theme","light")
        }
    } else {
        if (document.documentElement.classList.contains("dark")) {
            document.documentElement.classList.remove("dark")
            localStorage.setItem("color-theme","light")
        } else {
            document.documentElement.classList.add("dark")
            localStorage.setItem("color-theme","dark")
        }
    }
})


const themeToggle = document.getElementById('theme-toggle')
const currentTheme = localStorage.getItem('theme')

if (currentTheme === 'dark') {
    document.body.classList.add('dark-mode')
    themeToggle.checked = true
}

themeToggle.addEventListener('change',() => {
    if (themeToggle.checked) {
        document.body.classList.add('dark-mode')
        localStorage.setItem('theme','dark')
    } else {
        document.body.classList.remove('dark-mode')
        localStorage.setItem('theme','light')
    }
})