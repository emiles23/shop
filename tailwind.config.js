import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            colors: {

                primary: {
                  300:"#cbd5e1",
                  200:"#e2e8f0",
                  100:"#f1f5f9",
                  50:"#f8fafc",
                },
                secondary: {
                  1000: "#0f172a",
                  900:"#1e293b",
                  800:"#334155",
                  600:"#475569",
                  500:"#64748b",
                  400:"#94a3b8"
                
                 
                },
        
                tertiary:{
                  950:"#082f49",
                  900:"#0c4a6e",
                  800:"#075985",
                  700:"#0369a1",
                  600:"#0284c7",
                  500:"#0ea5e9",       
                  400:"#38bdf8",      
                  // 300:"#7dd3fc",        
                  // 200:"#bae6fd",
                  // 100:"#e0f2fe",
                  // 50:'#f0f9ff'
                }
              }
        },

        
    },

    plugins: [forms, typography],
};
