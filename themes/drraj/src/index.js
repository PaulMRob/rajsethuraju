import "../css/style.scss"
import "@glidejs/glide/dist/css/glide.core.min.css"
// Optional: for default arrows, bullets styling
import "@glidejs/glide/dist/css/glide.theme.min.css"

// Our modules / classes
import MobileMenu from "./modules/MobileMenu"
import HeroSlider from "./modules/HeroSlider"
import Search from "./modules/Search"

// Instantiate a new object using our modules/classes
const mobileMenu = new MobileMenu()
const heroSlider = new HeroSlider()
const search = new Search()
