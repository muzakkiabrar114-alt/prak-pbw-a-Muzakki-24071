<?php

use App\Models\Post;
use App\Models\User;

test('guest is redirected to login for every post management route', function () {
    $post = Post::create([
        'title' => 'Contoh',
        'body' => 'Isi contoh',
    ]);

    $this->get(route('posts.index'))->assertRedirect(route('login'));
    $this->get(route('posts.create'))->assertRedirect(route('login'));
    $this->post(route('posts.store'), [])->assertRedirect(route('login'));
    $this->get(route('posts.show', $post))->assertRedirect(route('login'));
    $this->get(route('posts.edit', $post))->assertRedirect(route('login'));
    $this->put(route('posts.update', $post), [])->assertRedirect(route('login'));
    $this->patch(route('posts.update', $post), [])->assertRedirect(route('login'));
    $this->delete(route('posts.destroy', $post))->assertRedirect(route('login'));
});

test('welcome page offers authentication links to guests', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee(route('login'))
        ->assertSee(route('register'));
});

test('authenticated users can browse post pages', function () {
    $this->actingAs(User::factory()->create());
    $post = Post::create([
        'title' => 'Contoh',
        'body' => 'Isi contoh',
    ]);

    $this->get(route('posts.index'))->assertOk()->assertSee('Contoh');
    $this->get(route('posts.create'))->assertOk();
    $this->get(route('posts.show', $post))->assertOk()->assertSee('Isi contoh');
    $this->get(route('posts.edit', $post))->assertOk();
});

test('authenticated users can create update and delete posts', function () {
    $this->actingAs(User::factory()->create());

    $this->post(route('posts.store'), [
        'title' => 'Judul awal',
        'body' => 'Isi awal',
    ])->assertRedirect();

    $post = Post::firstOrFail();
    expect($post->title)->toBe('Judul awal')
        ->and($post->body)->toBe('Isi awal');

    $this->put(route('posts.update', $post), [
        'title' => 'Judul diperbarui',
        'body' => 'Isi diperbarui',
    ])->assertRedirect(route('posts.show', $post));

    expect($post->fresh()->title)->toBe('Judul diperbarui');

    $this->delete(route('posts.destroy', $post))
        ->assertRedirect(route('posts.index'));

    $this->assertDatabaseMissing('posts', ['id' => $post->id]);
});
