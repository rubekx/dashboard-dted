<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Email
 *
 * @property int $id
 * @property int|null $chamado
 * @property int|null $staff_id
 * @property int|null $dept_id
 * @property int|null $team_id
 * @property int|null $aluno_id
 * @property int $user_id
 * @property int|null $tipo_email
 * @property string|null $conteudo
 * @property string|null $status_chamado
 * @property int|null $info
 * @property mixed|null $enviado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Email newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Email newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Email query()
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereAlunoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereChamado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereConteudo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereDeptId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereEnviado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereStaffId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereStatusChamado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereTipoEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Email whereUserId($value)
 * @mixin \Eloquent
 */
class Email extends Model
{
    use HasFactory;
}
