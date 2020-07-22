<?php
/**
 * Created by PhpStorm.
 * User: xuant
 * Date: 10/23/2018
 * Time: 11:47 PM
 */

namespace app\models;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;


class UserSearchAdmin extends Editor
{
    public $id;
    public $Status;
    public $Date_Create;
    public $Role;
    public $Email;
    public $Phone_Number;
    public function rules()
    {
        $rules = [
            [['Status','id','Date_Create','Role','Email','Phone_Number'],'filter','filter'=>'\yii\helpers\HtmlPurifier::process'],
            [['id','Role'], 'integer'],
        ];
        return array_merge(parent::rules(),$rules);
        /*return [
                [['Status','Completed_order','Skill_Writer','Writer_id'], 'integer'],
    ];*/
    }
    public function search($params) {
        //$query = Editor::find()->innerJoinWith('skillWriter', true);
        $query = User::find();
        $pagination_writers = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' =>$query->count(),
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => $pagination_writers,
        ]);
        /*$dataProvider->setSort([
            'attributes' => [
                'Writer_id' => [
                    'asc' => ['Writer_id' => SORT_ASC],
                    'desc' => ['Writer_id' => SORT_DESC],
                    //'label' => 'Full Name',
                    'default' => SORT_DESC
                ],
                'Status'=>[
                    'asc' => ['Status' => SORT_ASC],
                    'desc' => ['Status' => SORT_DESC],
                    //'label' => 'Full Name',
                    'default' => SORT_DESC
                ],
                //'country_id'
            ]
        ]);*/
        //$dataProvider->sort = ['defaultOrder' => ['Completed_order' => 'DESC']];
        //$dataProvider->sort = ['defaultOrder' => ['Rating' => 'DESC']];
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            //$query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere(['like', 'EmailID', $this->Email]);
        $query->andFilterWhere(['Status'=> $this->Status,]);
        $query->andFilterWhere(['like','Phone_Number',$this->Phone_Number,]);
        $query->andFilterWhere(['like','Date_Create',$this->Date_Create,]);
        $query->andFilterWhere(['Role'=> $this->Role,]);
        return $dataProvider;
    }
}
