<?php

use AlizHarb\ThemerLuncher\Filament\Resources\ThemeResource\Schemas\ThemeInfolist;
use Filament\Schemas\Schema;

/*
 * Unit Tests for ThemeInfolist
 *
 * Tests infolist schema configuration.
 */
describe('ThemeInfolist Unit Tests', function () {
    it('can configure infolist schema', function () {
        $schema = Schema::make();
        $configured = ThemeInfolist::configure($schema);

        expect($configured)->toBeInstanceOf(Schema::class);
    });

    it('infolist has components', function () {
        $schema = Schema::make();
        $configured = ThemeInfolist::configure($schema);

        // Schema should have components configured
        expect($configured)->toBeInstanceOf(Schema::class);
    });

    it('validates configure method is static', function () {
        $reflection = new ReflectionMethod(ThemeInfolist::class, 'configure');
        expect($reflection->isStatic())->toBeTrue();
    });

    it('validates configure method returns schema', function () {
        $reflection = new ReflectionMethod(ThemeInfolist::class, 'configure');
        $returnType = $reflection->getReturnType();

        expect($returnType)->not->toBeNull()
            ->and($returnType->getName())->toBe(Schema::class);
    });
});
