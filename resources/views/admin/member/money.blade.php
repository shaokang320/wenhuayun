@extends('admin.layouts.app')
@section('title', '账户记录列表')

@section('content')
    <h2 class="sub-header">返佣记录列表</h2>

    <form name="listarc">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr class="info">
                    <th>ID</th>
                    <th>消费会员</th>
                    <th>订单号</th>
                    <th>订单金额</th>
                    <th>返佣金额</th>
                    <th>返佣比例</th>
                    <th>返佣会员</th>
                    <th>说明</th>
                    <th>时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if($posts){foreach($posts as $row){ ?>
                <tr>
                    <td><?php echo $row->commission_id; ?></td>
                    <td>
                        <a ><?php if ($row->user->member_name) {
                                echo $row->user->member_name;
                            } ?></a>
                    </td>
                    <td><?php echo $row->order_sn; ?></td>
                    <td><?php echo $row->order_money; ?></td>
                    <td><font<?php if ($row->commission_type == 2) {
                            echo ' color="#0C0"';
                        } else {
                            echo ' color="red"';
                        } ?>>
                            <?php if ($row->commission_type == 2) {
                                echo '-';
                            } ?><?php echo $row->commission_money; ?></font>
                    </td>
                    <td><?php echo $row->commission_proportion; ?></td>
                    <td><?php echo $row->pUser->member_name; ?></td>
                    <td><?php echo $row->commission_describe; ?></td>
                    <td><?php echo $row->createTime; ?></td>
                    <td><a href="<?php echo route('admin_order_detail', array('order_id' => $row->order_id)); ?>">详情</a></td>
                </tr><?php }} ?>
                </tbody>
            </table>
        </div><!-- 表格结束 --></form><!-- 表单结束 -->

    <nav aria-label="Page navigation">{{ $posts->links() }}</nav>
@endsection