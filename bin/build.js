import * as esbuild from 'esbuild';

esbuild.build({
    entryPoints: ['./resources/js/filament-json-field.js'],
    outfile: './dist/filament-json-field.js',
    bundle: true,
    mainFields: ['module', 'main'],
    platform: 'browser',
    treeShaking: true,
    target: ['es2020'],
    minify: true,
});
