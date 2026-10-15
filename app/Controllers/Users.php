<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\HTTP\RedirectResponse;

class Users extends BaseController
{
    public function index(): string
    {
        $userModel = new UserModel();
        $users = $userModel->findAll();

        return view('users/index', ['users' => $users]);
    }

    public function new(): string
    {
        return view('users/form', [
            'title' => 'New User',
            'user'  => null,
        ]);
    }

    public function create(): RedirectResponse
    {
        $data = $this->userData();

        if (! $this->validateData($data, $this->userRules())) {
            return redirect()->to(site_url('users/new'))->withInput()->with('errors', $this->validator->getErrors());
        }

        $data['created_at'] = date('Y-m-d H:i:s');
        (new UserModel())->insert($data);

        return redirect()->to(site_url('users'))->with('success', 'User account created.');
    }

    public function edit(int $id): string
    {
        return view('users/form', [
            'title' => 'Edit User',
            'user'  => $this->findUser($id),
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        $user = $this->findUser($id);
        $data = $this->userData();

        $avatar = $this->request->getFile('avatar');
        $hasAvatar = $avatar !== null && $avatar->getError() !== UPLOAD_ERR_NO_FILE;
        $rules = $this->userRules($id);

        if ($hasAvatar) {
            $rules['avatar'] = [
                'label' => 'Profile picture',
                'rules' => [
                    'uploaded[avatar]',
                    'is_image[avatar]',
                    'mime_in[avatar,image/jpg,image/jpeg,image/png]',
                    'ext_in[avatar,jpg,jpeg,png]',
                    'max_size[avatar,2048]',
                ],
            ];
        }

        if (! $this->validateData($data, $rules)) {
            return redirect()->to(site_url('users/' . $id . '/edit'))->withInput()->with('errors', $this->validator->getErrors());
        }

        $newAvatar = null;

        try {
            if ($hasAvatar && $avatar instanceof UploadedFile) {
                $newAvatar = $this->prepareAvatar($avatar);
                $data['avatar'] = $newAvatar;
            }

            (new UserModel())->update($id, $data);
        } catch (\Throwable $exception) {
            if ($newAvatar !== null) {
                $this->deleteAvatar($newAvatar);
            }

            log_message('error', 'Unable to update user {id}: {message}', [
                'id'      => $id,
                'message' => $exception->getMessage(),
            ]);

            return redirect()->to(site_url('users/' . $id . '/edit'))->withInput()->with('errors', [
                'avatar' => 'The profile picture could not be prepared. Please try another JPG or PNG.',
            ]);
        }

        if ($newAvatar !== null && ! empty($user['avatar'])) {
            $this->deleteAvatar((string) $user['avatar']);
        }

        return redirect()->to(site_url('users'))->with('success', 'User account updated.');
    }

    /** @return array{username: string, full_name: string} */
    private function userData(): array
    {
        return [
            'username'  => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
        ];
    }

    /** @return array<string, array{label: string, rules: list<string>}> */
    private function userRules(?int $id = null): array
    {
        $uniqueRule = $id === null
            ? 'is_unique[users.username]'
            : 'is_unique[users.username,id,' . $id . ']';

        return [
            'username' => [
                'label' => 'Username',
                'rules' => ['required', 'max_length[50]', $uniqueRule],
            ],
            'full_name' => [
                'label' => 'Full name',
                'rules' => ['required', 'max_length[100]'],
            ],
        ];
    }

    /** @return array<string, mixed> */
    private function findUser(int $id): array
    {
        $user = (new UserModel())->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User not found.');
        }

        return $user;
    }

    private function prepareAvatar(UploadedFile $avatar): string
    {
        $uploadDirectory = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';

        if (! is_dir($uploadDirectory) && ! mkdir($uploadDirectory, 0775, true) && ! is_dir($uploadDirectory)) {
            throw new \RuntimeException('Unable to create the avatar upload directory.');
        }

        $filename = $avatar->getRandomName();
        $target = $uploadDirectory . DIRECTORY_SEPARATOR . $filename;

        service('image', 'gd')
            ->withFile($avatar->getTempName())
            ->fit(300, 300, 'center')
            ->save($target, 85);

        return $filename;
    }

    private function deleteAvatar(string $filename): void
    {
        $safeFilename = basename($filename);
        $path = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars' . DIRECTORY_SEPARATOR . $safeFilename;

        if (is_file($path)) {
            unlink($path);
        }
    }
}
