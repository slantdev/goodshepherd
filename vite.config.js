import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";
import browserSync from "browser-sync";

export default defineConfig({
  plugins: [
    tailwindcss(),
    {
      name: "browser-sync",
      apply: "serve",
      configureServer(server) {
        const bs = browserSync.create();
        bs.init({
          proxy: "https://goodshep2025.local",
          files: ["**/*.php"],
          notify: false,
          open: true,
        });
      },
    },
  ],
  build: {
    outDir: "assets",
    rollupOptions: {
      input: {
        main: "./src/main.js",
      },
      output: {
        entryFileNames: "js/[name].js",
        chunkFileNames: "js/[name].js",
        assetFileNames: ({ name }) => {
          if (/\.css$/.test(name ?? "")) {
            return "css/[name].[ext]";
          }
          return "[name].[ext]";
        },
      },
    },
  },
  server: {
    strictPort: true,
    port: 5173,
    hmr: {
      host: "localhost",
    },
  },
});
