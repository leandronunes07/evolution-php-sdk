<?php

namespace LeandroNunes\Evolution\Resources;

use LeandroNunes\Evolution\Exceptions\ValidationException;

class Group extends BaseResource
{
    public function create(string $instance, string $subject, array $participants, string $description = '', array $options = []): array
    {
        $body = array_merge([
            'subject' => $subject,
            'participants' => $participants,
            'description' => $description,
        ], $options);

        return $this->httpClient->request('POST', "group/create/{$instance}", ['json' => $body]);
    }

    public function updateGroupPicture(string $instance, string $groupJid, string $image): array
    {
        return $this->httpClient->request('POST', "group/updateGroupPicture/{$instance}", [
            'query' => ['groupJid' => $groupJid],
            'json' => ['image' => $image]
        ]);
    }

    public function updateGroupSubject(string $instance, string $groupJid, string $subject): array
    {
        return $this->httpClient->request('POST', "group/updateGroupSubject/{$instance}", [
            'query' => ['groupJid' => $groupJid],
            'json' => ['subject' => $subject]
        ]);
    }

    public function updateGroupDescription(string $instance, string $groupJid, string $description): array
    {
        return $this->httpClient->request('POST', "group/updateGroupDescription/{$instance}", [
            'query' => ['groupJid' => $groupJid],
            'json' => ['description' => $description]
        ]);
    }

    public function inviteCode(string $instance, string $groupJid): array
    {
        return $this->httpClient->request('GET', "group/inviteCode/{$instance}", [
            'query' => ['groupJid' => $groupJid]
        ]);
    }

    public function revokeInviteCode(string $instance, string $groupJid): array
    {
        return $this->httpClient->request('POST', "group/revokeInviteCode/{$instance}", [
            'query' => ['groupJid' => $groupJid]
        ]);
    }

    public function sendInvite(string $instance, string $groupJid, string $description, array $numbers): array
    {
        return $this->httpClient->request('POST', "group/sendInvite/{$instance}", [
            'json' => [
                'groupJid' => $groupJid,
                'description' => $description,
                'numbers' => $numbers
            ]
        ]);
    }

    public function inviteInfo(string $instance, string $inviteCode): array
    {
        return $this->httpClient->request('GET', "group/inviteInfo/{$instance}", [
            'query' => ['inviteCode' => $inviteCode]
        ]);
    }

    public function findGroupInfos(string $instance, string $groupJid): array
    {
        return $this->httpClient->request('GET', "group/findGroupInfos/{$instance}", [
            'query' => ['groupJid' => $groupJid]
        ]);
    }

    public function fetchAllGroups(string $instance, bool $getParticipants = false): array
    {
        return $this->httpClient->request('GET', "group/fetchAllGroups/{$instance}", [
            'query' => ['getParticipants' => $getParticipants ? 'true' : 'false']
        ]);
    }

    public function participants(string $instance, string $groupJid): array
    {
        return $this->httpClient->request('GET', "group/participants/{$instance}", [
            'query' => ['groupJid' => $groupJid]
        ]);
    }

    public function updateParticipant(string $instance, string $groupJid, string $action, array $participants): array
    {
        $allowedActions = ['add', 'remove', 'promote', 'demote'];
        if (!in_array($action, $allowedActions)) {
            throw new ValidationException("Invalid action. Allowed: " . implode(', ', $allowedActions));
        }

        return $this->httpClient->request('POST', "group/updateParticipant/{$instance}", [
            'query' => ['groupJid' => $groupJid],
            'json' => [
                'action' => $action,
                'participants' => $participants
            ]
        ]);
    }

    public function updateSetting(string $instance, string $groupJid, string $action): array
    {
        $allowedActions = ['announcement', 'not_announcement', 'locked', 'unlocked'];
        if (!in_array($action, $allowedActions)) {
            throw new ValidationException("Invalid action. Allowed: " . implode(', ', $allowedActions));
        }

        return $this->httpClient->request('POST', "group/updateSetting/{$instance}", [
            'query' => ['groupJid' => $groupJid],
            'json' => ['action' => $action]
        ]);
    }

    public function toggleEphemeral(string $instance, string $groupJid, int $expiration): array
    {
        return $this->httpClient->request('POST', "group/toggleEphemeral/{$instance}", [
            'query' => ['groupJid' => $groupJid],
            'json' => ['expiration' => $expiration]
        ]);
    }

    public function leaveGroup(string $instance, string $groupJid): array
    {
        return $this->httpClient->request('DELETE', "group/leaveGroup/{$instance}", [
            'query' => ['groupJid' => $groupJid]
        ]);
    }
}
